<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class EmailsendingTwo extends CI_Controller {

    public function index() {

        //create DOMDocument object
        $dom = new DOMDocument;
        //load xml file
        //  $dom->load('http://localhost/AirLineSOAPProject.V2/AirCreateReservationRsp.xml');
        $dom->load('C:\xampp\htdocs\IBE-Codeignitor-project1\application\controllers\AirCreateReservationRsp.xml');
        //save dom object as string

        $valuenew = $dom->saveXML();
        //$xml = simplexml_load_String("$valuenew", null, null, 'SOAP', true);
        $xml = simplexml_load_String("$valuenew");

      
        $this->parseAirCreateReservationRsp($xml);
    }

    public function parseAirCreateReservationRsp($xml) { //parse the Search response to get values to use in detail request
        $messageArray = array();
        $UniversalRecord = array();
        $personalDetails = array();
        $airlineDetails = array();
        $ticketDetails = array();
        $BaggageAllowance = array();
        $FareInfo = array();
        $AirSegmentDetails = array();


        $soapBody = $xml->children('SOAP', true);
        $AirCreateReservationRspChild=$soapBody->children('universal', true);

            if (strcmp($AirCreateReservationRspChild->getName(), 'AirCreateReservationRsp') == 0) {
                foreach ($AirCreateReservationRspChild->children('universal', true) as $nodes2) {
                    if (strcmp($nodes2->getName(), 'UniversalRecord') == 0) {
                       
                        foreach ($nodes2->attributes() as $a => $b) {
                            $UniversalRecord[$a] = $b;
                          
                        }
                    }
                }
            }
        
       

        //fetch the personal details of travellers
        $count = 0;
        if (strcmp($AirCreateReservationRspChild->getName(), 'AirCreateReservationRsp') == 0) {
        foreach ($AirCreateReservationRspChild->children('universal', true) as $nodes1) {
            foreach ($nodes1->children('common_v33_0', true) as $nodes2) {//BookingTraveler
                if (strcmp($nodes2->getName(), 'BookingTraveler') == 0) {//PhoneNumber
                    foreach ($nodes2->attributes() as $a => $b) {
                        $personalDetails[$count][$a] = $b;
                    }
                }


                foreach ($nodes2->children('common_v33_0', true) as $nodes3) {//BookingTravelerName
                    if (strcmp($nodes3->getName(), 'BookingTravelerName') == 0) {//
                        foreach ($nodes3->attributes() as $a => $b) {
                            $personalDetails[$count][$a] = $b;
                        }
                    }

                    if (strcmp($nodes3->getName(), 'PhoneNumber') == 0) {//PhoneNumber
                        foreach ($nodes3->attributes() as $a => $b) {
                            $personalDetails[$count][$a] = $b;
                        }
                    }

                    if (strcmp($nodes3->getName(), 'Email') == 0) {//PhoneNumber
                        foreach ($nodes3->attributes() as $a => $b) {
                            $personalDetails[$count][$a] = $b;
                        }
                    }
                }
                $count++;
            }
        }
    }
    
        //---------------------------------------------------------------------------------------------------------------
        //fetch the airline details
        $count2 = 0;

        $airlineDetails;
         if (strcmp($AirCreateReservationRspChild->getName(), 'AirCreateReservationRsp') == 0) {
        foreach ($AirCreateReservationRspChild->children('universal', true) as $nodes1) {
            foreach ($nodes1->children('air', true) as $nodes2) {//AirReservation
                if (strcmp($nodes2->getName(), 'AirReservation') == 0) {
                    foreach ($nodes2->attributes() as $a => $b) {
                        $airlineDetails[$a] = $b;
                    }
                }

                foreach ($nodes2->children('air', true) as $nodes3) {//air:AirSegment
                    if (strcmp($nodes3->getName(), 'AirSegment') == 0) {
                        foreach ($nodes3->attributes() as $a => $b) {
                            $AirSegmentDetails[$count2][$a] = $b;
                        }
                    }


                    foreach ($nodes3->children('air', true) as $nodes4) {//air:FlightDetails
                        if (strcmp($nodes4->getName(), 'FlightDetails') == 0) {

                            foreach ($nodes4->attributes() as $a => $b) {

                                $AirSegmentDetails[$count2][$a] = $b;
                            }

                        }
                    }
                    $count2++;
                }//air:AirSegment
            }

            $airlineDetails['AirSegmentDetails'] = $AirSegmentDetails;
        }
    }
    
        //---------------------------------------------------------------------------

        $count5 = 0;
         if (strcmp($AirCreateReservationRspChild->getName(), 'AirCreateReservationRsp') == 0) {
        foreach ($AirCreateReservationRspChild->children('universal', true) as $nodes1) {
            foreach ($nodes1->children('air', true) as $nodes2) {
                foreach ($nodes2->children('air', true) as $nodes3) {//AirPricingInfo
                    foreach ($nodes3->children('air', true) as $nodes4) {//FareInfo
                        foreach ($nodes4->children('air', true) as $nodes5) {//BaggageAllowance
                            foreach ($nodes5->children('air', true) as $nodes6) {//MaxWeight
                                if (strcmp($nodes6->getName(), 'MaxWeight') == 0) {

                                    foreach ($nodes6->attributes() as $a => $b) {

                                        $BaggageAllowance[$count5][$a] = $b;
                                    }
                                    
                                    $count5++;
                                }
                            }
                        }///
                    }/////
                }//air:AirSegment
            }
        }
    }

        // echo json_encode($BaggageAllowance);
        $ticketDetails['UniversalRecord'] = $UniversalRecord;
        $ticketDetails['personalDetails'] = $personalDetails;
        $ticketDetails['airlineDetails'] = $airlineDetails;
        $ticketDetails['BaggageDetails'] = $BaggageAllowance;

      //  echo json_encode($ticketDetails);

        $this->load->view('emailView',$ticketDetails);
        //$this->load->view('Findmyfare_Colombo_to_Singapore');
    }

    public function emailGenerate() {
        
    }

}
