<?php 
    $stockvalue = $this->dbo->stockvalue();
    $outPurchase = $overallStatus->NetPurchase - $overallStatus->NetPPayment;
    $outSale = $overallStatus->NetSale - $overallStatus->NetSalePayment;
    $estimateProfit = $overallStatus->NetSale - $overallStatus->NetPurchase;
 ?>
 <div id="container" class="row-fluid">
<?php $this->load->view('sidebar'); ?>
<div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                 <h3 class="page-title">
                     Dashboard
                   </h3>
                   <?php $this->load->view('msg'); ?>
                   <div class="row-fluid">
                     <div class="span8">
                     <div class="widget green">
                        <div class="widget-title">
                            <h4>Estimated Statistics.</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                           <div id="overallStatus"></div>
                        </div>
                    </div>
                      
                     </div>
                     <div class="span4 text-center">
                      <strong><?php echo date('l jS \of F Y'); ?></strong>
                       <div id="clock">
                       </div>
                     </div>
                   </div>
                   <div class="row-fluid">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-title">
                                <h4><i class="icon-th-large"></i> Quick Links </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                            </div>
                            <div class="widget-body">
                                <!--BEGIN METRO STATES-->
                                <div class="row-fluid">
                                    <!--BEGIN METRO STATES-->
                                    <div class="metro-nav">
                                        <div class="metro-nav-block nav-block-orange">
                                            <a data-original-title="" href="<?php echo site_url('products'); ?>">
                                                <div class="info"><?php echo $qLinksData->totalProducts; ?></div>
                                                <div class="status">Products</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-block-yellow">
                                            <a data-original-title="" href="<?php echo site_url('products/addProduct'); ?>">
                                                <!-- <div class="info">+970</div> -->
                                                <div class="status">Add Product</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-olive">
                                            <a data-original-title="" href="<?php echo site_url('purchase/viewSuppliers'); ?>">
                                                <div class="info"><?php echo $qLinksData->totalSuppliers; ?></div>
                                                <div class="status">Suppliers</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-deep-terques">
                                            <a data-original-title="" href="<?php echo site_url('purchase/addSupplier'); ?>">
                                                <!-- <div class="info">+897</div> -->
                                                <div class="status">Add Supplier</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-block-red">
                                            <a data-original-title="" href="<?php echo site_url('sale/viewCustomers'); ?>">
                                                <div class="info"><?php echo $qLinksData->totalCustomers; ?></div>
                                                <div class="status">Customers</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="metro-nav">
                                        <div class="metro-nav-block nav-light-purple">
                                            <a data-original-title="" href="<?php echo site_url('sale/addCustomer'); ?>">
                                                <!-- <div class="info">29</div> -->
                                                <div class="status">Add Customer</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-light-blue">
                                            <a data-original-title="" href="<?php echo site_url('purchase/viewPurchases'); ?>">
                                                <div class="info"><?php echo $qLinksData->totalPO; ?></div>
                                                <div class="status">Purchases</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-light-green">
                                            <a data-original-title="" href="<?php echo site_url('purchase/addPOrder'); ?>">
                                                <!-- <div class="info">123</div> -->
                                                <div class="status">Add Purchase</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-light-brown">
                                            <a data-original-title="" href="<?php echo site_url('purchase/viewPPayments'); ?>">
                                                <div class="info"><?php echo $qLinksData->totalPP; ?></div>
                                                <div class="status">Purchase Payments</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-block-grey ">
                                            <a data-original-title="" href="<?php echo site_url('purchase/addPPayment'); ?>">
                                                <!-- <div class="info">$53412</div> -->
                                                <div class="status">Add Purchase Payment</div>
                                            </a>
                                        </div>
                                          <div class="metro-nav-block nav-block-yellow">
                                            <a data-original-title="" href="<?php echo site_url('sale/viewSales'); ?>">
                                                <div class="info"><?php echo $qLinksData->totalSale; ?></div>
                                                <div class="status">Sales</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-light-blue">
                                            <a data-original-title="" href="<?php echo site_url('sale/addSOrder'); ?>">
                                                <!-- <div class="info">$53412</div> -->
                                                <div class="status">Add Sale</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-light-green">
                                            <a data-original-title="" href="<?php echo site_url('sale/viewPayments'); ?>">
                                                <div class="info"><?php echo $qLinksData->totalSalePayment; ?></div>
                                                <div class="status">Sale Payment</div>
                                            </a>
                                        </div>
                                        <div class="metro-nav-block nav-block-orange ">
                                            <a data-original-title="" href="<?php echo site_url('sale/addPayment'); ?>">
                                                <!-- <div class="info">$53412</div> -->
                                                <div class="status">Add Sale Payment</div>
                                            </a>
                                        </div>
                                       <!--  <div class="metro-nav-block nav-block-orange ">
                                            <a data-original-title="" href="#">
                                                <div class="info">$53412</div>
                                                <div class="status">Add Sale</div>
                                            </a>
                                        </div> -->
                                    </div>
                                    <!--END METRO STATES-->
                                </div>
                                <div class="clearfix"></div>
                                <!--END METRO STATES-->
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row-fluid">
                     <div class="span12">
                         <div class="widget yellow">
                        <div class="widget-title">
                            <h4><i class="icon-calendar"></i><?php echo date("M-Y"); ?> Average</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div style="min-height:1600px;" id="currentMonthChart"></div>
                        </div>
                    </div>
                     </div>
                   </div>
                   <div class="row-fluid">
                      <div class="span12">
                      <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-calendar"></i>Recent Stock Position by least availability( 10 Products ).</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div id="stockledgerChart"></div>
                        </div>
                    </div>
                     </div>
                   </div>
                   <div class="row-fluid">
                     <div class="span6">
                      <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-calendar"></i>Top 10 High Amount Supplier.</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div id="outStandingSupplier"></div>
                        </div>
                    </div>
                     </div>
                     <div class="span6">
                     <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-calendar"></i>Top 10 High Amount Customer.</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div id="outStanding"></div>
                        </div>
                    </div>
                     </div>
                   </div>
                  
               </div>
            </div>
        </div>
</div>
</div>
<?php $this->load->view('scripts'); ?>
<script type="text/javascript">
  $(function(){
    // ready
    

    $('#overallStatus').highcharts({
        chart: {
            renderTo: 'container',
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
        credits : {
          enabled : false
        },
        title: {
            text: 'Estimated Statistics'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [
        {
            name: "Net Purchase",
            data: [<?php echo $overallStatus->NetPurchase; ?>,]
        },
         {
            name: "Net Purchase Amount",
            data: [<?php echo $overallStatus->NetPPayment; ?>]
        },
         {
            name: "Outstanding Purchase",
            data: [<?php echo $outPurchase; ?>]
        },
         {
            name: "Net Sale",
            data: [<?php echo $overallStatus->NetSale; ?>]
        },
         {
            name: "Net Sale Amount",
            data: [<?php echo $overallStatus->NetSalePayment; ?>]
        },
         {
            name: "Outstanding Sale",
            data: [<?php echo $outSale; ?>]
        },
         {
            name: "Estimated Earnings",
            data: [<?php echo $estimateProfit; ?>]
        }
        ]
    });

     

    $('#stockAmountChart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
         credits: {
            enabled: false
        },
        title: {
            text: 'Stock Value By Cost and Price'
        },
        series: [{
            type: 'pie',
            name: 'Stock Value',
            data: [
                ['By Cost',   <?php echo $stockvalue->row()->bycost; ?>],
                ['By Price',   <?php echo $stockvalue->row()->byprice; ?>]
            ]
        }]
    });



       $('#stockledgerChart').highcharts({
        chart: {
            type: 'column'
        },
        credits : {
          enabled : false
        },
        title: {
            text: 'Stock Ledger'
        },
        tooltip: {
            pointFormat: '{point.y}</b>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            title: {
                text: 'Quantity'
            }
        },
        series: [{
          name : "Products",
            data: [
               <?php $x=1; foreach ($slchart->result() as $rows) {
          ?>
          
            [  '<?php echo $rows->Name; ?>',
             <?php echo $rows->Avail; ?>]<?php echo (($x == $slchart->num_rows()) ? null : ","); ?>
           <?php
        $x=1; } ?>
             ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                x: 4,
                y: 10,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif',
                    textShadow: '0 0 3px black'
                }
            }
        }]
    });

     $('#outStanding').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
         credits: {
            enabled: false
        },
        title: {
            text: 'High Amount Customers'
        },
        series: [{
            type: 'pie',
            name: 'Outstanding Status',
            data: [
            <?php $y = 1; foreach ($highCustomers->result() as $customer) 
            {
              ?> [<?php echo "'$customer->Name'"; ?>,<?php echo $customer->Balance; ?>]<?php echo (($y == $highCustomers->num_rows()) ? null : "," );
            $y++;} ?>
            ]
        }]
    });

      $('#outStandingSupplier').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
         credits: {
            enabled: false
        },
        title: {
            text: 'High Amount Suppliers'
        },
        series: [{
            type: 'pie',
            name: 'Outstanding Status',
            data: [
            <?php $y = 1; foreach ($highSuppliers->result() as $supplier) 
            {
              ?> [<?php echo "'$supplier->Name'"; ?>,<?php echo $supplier->Balance; ?>]<?php echo (($y == $highSuppliers->num_rows()) ? null : "," );
            $y++;} ?>
            ]
        }]
    });

     $('#currentMonthChart').highcharts({
        chart: {
            type: 'bar'
        },
        credits : {
          enabled : false
        },
        title: {
            text: '<?php echo date("M-Y"); ?> Average'
        },
        subtitle: {
            text: 'Estimated Statistics'
        },
        xAxis: {
            categories: [
                <?php for ($i = 1; $i <= date('t'); $i++) {
                  ?>
                  '<?php echo date($i."-M"); ?>'<?php echo (($i == date('t')) ? null : ","); ?>
                  <?php
                }; ?>
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Amount (PKR)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} PKR</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Purchase',
            data: [
            <?php for ($i=0; $i < count($purchaseArray) ; $i++) { echo $purchaseArray[$i].(($i==count($purchaseArray)-1) ? null : ","); } ?>
            ]

        }, {
            name: 'Sale',
            data: [
            <?php for ($i=0; $i < count($saleArray) ; $i++) { echo $saleArray[$i].(($i==count($saleArray)-1) ? null : ","); } ?>
            ]

        }, {
            name: 'Amount Paid(Purchase Amount)',
            data: [
            <?php for ($i=0; $i < count($pPaidArray) ; $i++) { echo $pPaidArray[$i].(($i==count($pPaidArray)-1) ? null : ","); } ?>
            ]

        }, {
            name: 'Amount Received(Sale Amount)',
           data: [
            <?php for ($i=0; $i < count($sRecArray) ; $i++) { echo $sRecArray[$i].(($i==count($sRecArray)-1) ? null : ","); } ?>
            ]

        }]
    });



    // $('.widget .tools .icon-chevron-up').trigger('click');
    

   
    // end of ready
  });
</script>







