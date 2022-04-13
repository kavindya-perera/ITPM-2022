<?php 
    require 'vendor/autoload.php';

    $content='
    <style>
    body{margin-top:20px;
        background-color: #f7f7ff;
        }
        #invoice {
            padding: 0px;
        }
        
        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }
        
        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0d6efd
        }
        
        .invoice .company-details {
            text-align: right
        }
        
        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }
        
        .invoice .contacts {
            margin-bottom: 20px
        }
        
        .invoice .invoice-to {
            text-align: left
        }
        
        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }
        
        .invoice .invoice-details {
            text-align: right
        }
        
        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #0d6efd
        }
        
        .invoice main {
            padding-bottom: 50px
        }
        
        .invoice main .thanks {
            margin-top: 50px;
            font-size: 2em;
            margin-bottom: 50px
        }
        
        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }
        
        .invoice main .notices .notice {
            font-size: 1.2em
        }
        
        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }
        
        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }
        
        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }
        
        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #0d6efd;
            font-size: 1.2em
        }
        
        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }
        
        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #0d6efd
        }
        
        .invoice table .unit {
            background: #ddd
        }
        
        .invoice table .total {
            background: #0d6efd;
            color: #fff
        }
        
        .invoice table tbody tr:last-child td {
            border: none
        }
        
        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }
        
        .invoice table tfoot tr:first-child td {
            border-top: none
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0);
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }
        
        .invoice table tfoot tr:last-child td {
            color: #0d6efd;
            font-size: 1.4em;
            border-top: 1px solid #0d6efd
        }
        
        .invoice table tfoot tr td:first-child {
            border: none
        }
        
        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }
        
        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }
            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }
            .invoice>div:last-child {
                page-break-before: always
            }
        }
        
        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }
    </style>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="invoice">
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                
                                    <div class="col company-details">
                                        <h2 class="name">
                                            Wayamba IT Campus
                                        </h2>
                                        <div>105/16 Fancy Building,Dickson Moters Rd, Kurunegala</div>
                                        <div>0377 405 680</div>
                                        <div>info@witc.lk</div>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">To:</div>
                                        <h2 class="to">'.$removelDetails[0]->JO_TO.'</h2>
                                        <div class="address">Contact Number - '.$removelDetails[0]->JO_CONTACT.'</div>
                                    </div>
                                    <div class="col invoice-details">
                                        <div class="date">Date '.date('Y-m-d').'</div>
                                    </div>
                                </div>
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">DATE</th>
                                            <th class="text-left">ITEM CODE</th>
                                            <th class="text-left">ITEM NAME</th>
                                            <th class="text-left">QTY</th>
                                        </tr>
                                    </thead>
                                <tbody>';

                           
                                    $count = 0;
                                    foreach($removelItemsDetails as $index=>$removelItemsDetail):
                                        $count++;
                              
                             
                        $content.='<tr>
                                    <th>'.$count.'</th>
                                    <td>'.$removelDetails[0]->JO_DATE .'</td>
                                    <td>'. $removelItemsDetail->ITEM_CODE .'</td>
                                    <td>'. $removelItemsDetail->ITEM_NAME .'</td>
                                    <td>'. $removelItemsDetail->JOI_QTY .'</td>
                                </tr>';

                            
                                    endforeach;
                            


                                $content.='
                                    </tbody>
                            
                                </table>

                                    <br><br>
                                    <table style="background-color:white;">
                                    <tr style="background-color:white;">
                                    <td style="background-color:white;" >
                                __________________________________<br>
                                Recipient Signature
                                </td>
                                <td style="background-color:white;">
                                __________________________________<br>
                                Verify
                                </td>
                                </tr>
                                </table>

                                <br><br>

                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">Please keep this document close to you</div>
                                </div>
                            </main>
                            <footer>Invoice was created on a witc.lk system and is valid without the signature and seal.</footer>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>';

    use Dompdf\Dompdf;

            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml(
                $content
            );
        
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');
        
            // Render the HTML as PDF
            $dompdf->render();
        
            // Output the generated PDF to Browser
            $dompdf->stream('Stock Out Report');
?>


