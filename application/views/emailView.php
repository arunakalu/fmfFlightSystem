<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">            
                <div class="row">
                    <div class="col-sm-6 pull-left" align="left" >
                        <h1>Travel Itinerary </h1> 
                        <p>(reservation copy)</p>
                    </div>
                    <div class="col-sm-6 pull-right" align="right">
                        <h3>Customer Care: </h3>  
                        <h4>Call 24/ 7 /365 Days </h4>
                        <h4>+94 117 24 7 365  </h4>
                        <h4>Email: flights@findmyfare.com </h4> 
                    </div>
                </div> 
                <hr>
                <div class="row">
                    <div class="col-sm-6 pull-left" >
                  
                        <h4> Airline PNR : <?php echo $UniversalRecord['LocatorCode']; ?> </h4>
                    </div>
                    <div class="col-sm-6 pull-right" align="right">
                        <h4>Booking Date :<?php echo $airlineDetails['CreateDate']; ?></h4>  
                    </div>
                </div> 
                <div class="row">
                    <br><br>
                    <table align="center" class="table">
                        <tr>
                            <th colspan="7"><h3><strong>Itinerary Details</strong></h3></th>
                                
                            
                        </tr>
                        <tr>
                            <th>
                                Flight
                            </th>
                            <th>
                                Aircraft
                            </th>
                            <th>
                                Departure
                            </th>
                            <th>
                                Arrival
                            </th>
                            <th>
                                Duration
                            </th>
                            <th>
                                Class Of Service
                            </th>
                            <th>
                                Status
                            </th>
                        </tr>
                       
                            <?php  $AirSegmentDetails=$airlineDetails['AirSegmentDetails'];; 
                            for($i=0;$i<sizeof($AirSegmentDetails);$i++){
                            ?>  <tr>
                                
                                <td><?php echo $AirSegmentDetails[$i]['Carrier'].' '.$AirSegmentDetails[$i]['FlightNumber'];?></td>
                                <td><?php echo $AirSegmentDetails[$i]['Equipment'];?></td>
                                <td><?php echo $AirSegmentDetails[$i]['Origin'].'<br>'.$AirSegmentDetails[$i]['DepartureTime'];?></td>
                                 <td><?php echo $AirSegmentDetails[$i]['Destination'].'<br>'.$AirSegmentDetails[$i]['ArrivalTime'];?></td>
                                 <td><?php $TravelTime=$AirSegmentDetails[$i]['TravelTime'];echo number_format($TravelTime/60, 2).' hrs' ;?></td>
                                  <td><?php echo $AirSegmentDetails[$i]['CabinClass'].' '.$AirSegmentDetails[$i]['ClassOfService'];?></td>
                                    <td><?php echo $AirSegmentDetails[$i]['Status'];?></td><?php
                            
                           ?> </tr><?php
                            }?>
                           
                        </tr>

                    </table>
                </div> 

                <hr>
                <div class="row">
                    <div class="col-sm-12" >
                        <div>
                            <h3><strong>Passenger Details</strong>  </h3>
                        </div> 

                    </div>                  
                     
                    <div class="col-sm-12">
                        <table>
                        <?php 
                        for($e=0;$e<sizeof($personalDetails);$e++)
                        {
                           
                            if($personalDetails[$e]['TravelerType']=='ADT')
                            {
                                
                                ?><tr><td><?php echo 'Adult '.'<br>'; ?></td></tr><?php
                            }elseif($personalDetails[$e]['TravelerType']=='CNN')
                            {
                                ?><tr><td><?php echo 'Child '.'<br>';?></td></tr><?php
                            }elseif($personalDetails[$e]['TravelerType']=='INF')
                            {
                               ?><tr><td><?php  echo 'Infant '.'<br>';?></td></tr><?php
                            }
                           
                            ?><tr><td><?php echo 'Name: '.$personalDetails[$e]['Prefix'].'.'.$personalDetails[$e]['First'].' '.$personalDetails[$e]['Last'];?></td></tr><?php
                            ?><tr><td><?php  
                            if($BaggageDetails==NULL)
                            { }
                            else{
                               // echo sizeof($BaggageDetails);
                               //echo 'Baggage Allowed: '.$BaggageDetails[$e]['Value']; 
                            }
                            ?></td></tr><?php
                           
                            }
                        
                         ?>
                       </table>
                        
                    </div>

                </div> 

                <hr>
                <div class="row">
                    <div class="col-sm-12" >
                        <div>
                            <h4>Additional Information </h4>
                        </div> 
                        <ul class="list-group">
                            <li class="list-group-item">NOT an Travel Document or E-Ticket.</li>
                            <li class="list-group-item">FARE MAY CHANGE UNLESS TICKETED.</li>
                            <li class="list-group-item">Some tickets require passport details before issuing.</li>
                            <li class="list-group-item">Our agents might contact you for verification purpose.</li>
                            <li class="list-group-item">Please check whether your name matches as it is in your passport.</li>
                            <li class="list-group-item">Payments must be realized and Ticket issued before Ticket Time Limit.</li>
                            <li class="list-group-item">Special fares are subject to penalties / Non- Refundable.</li>
                            <li class="list-group-item">Please use the MyTrip ID when communicating with us.</li>
                            <li class="list-group-item">Meal requests are subject to availability</li>
                        </ul>

                    </div>                  

                </div> 

            </div>            
        </div>



    </body>
</html>
