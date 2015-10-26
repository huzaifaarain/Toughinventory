 <!-- BEGIN SIDEBAR -->
      <div class="sidebar-scroll">
        <div id="sidebar" class="nav-collapse collapse">

         <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
         <div class="navbar-inverse">
            <form class="navbar-search visible-phone">
               <input type="text" class="search-query" placeholder="Search" />
            </form>
         </div>
         <!-- END RESPONSIVE QUICK SEARCH FORM -->
         <!-- BEGIN SIDEBAR MENU -->
          <ul class="sidebar-menu">
              <li class="sub-menu active">
                  <a class="" href="<?php echo site_url('dashboard'); ?>">
                      <i class="icon-dashboard"></i>
                      <span>Dashboard</span>
                  </a>
              </li>
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <span>Products</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="<?php echo site_url('products/addProduct'); ?>">Add Product</a></li>
                      <li><a class="" href="<?php echo site_url('products'); ?>">View Products</a></li>
                      <li><a class="" href="<?php echo site_url('products/stockLedger'); ?>">Stock Ledger</a></li>
                  </ul>
              </li>
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <span>Purchase</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="<?php echo site_url('purchase/addSupplier'); ?>">Add Supplier</a></li>
                      <li><a class="" href="<?php echo site_url('purchase/viewSuppliers'); ?>">View Supplier(s)</a></li>
                      <li><a class="" href="<?php echo site_url('purchase/supplierLedger'); ?>">Suppliers Ledger</a></li>
                      <li><a class="" href="<?php echo site_url('purchase/addPOrder'); ?>">Add Purchase</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('purchase/viewPurchases'); ?>" data-placement="top" data-original-title="All Purchases Orders">View Purchase(s)</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('purchase/addPPayment'); ?>" data-placement="top" data-original-title="New Purchase Payment">Add Payment</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('purchase/viewPPayments'); ?>" data-placement="top" data-original-title="All Purchase Payments">View Payment(s)</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('purchase/addPReturn'); ?>" data-placement="top" data-original-title="New Purchase Return (Damage Products)">Add P.Return</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('purchase/viewReturns'); ?>" data-placement="top" data-original-title="All Purchase Returns (Damage Products)">View P.Return(s)</a></li>
                      <!-- <li><a class="" href="<?php echo site_url('purchase/viewCSheet'); ?>">Closing Sheet</a></li> -->
                  </ul>
              </li>
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <span>Sale</span>
                      <span class="arrow"></span>
                  </a>
                   <ul class="sub">
                      <li><a class="" href="<?php echo site_url('sale/addCustomer'); ?>">Add Customer</a></li>
                      <li><a class="" href="<?php echo site_url('sale/viewCustomers'); ?>">View Customer(s)</a></li>
                      <li><a class="" href="<?php echo site_url('sale/customerLedger'); ?>">Customers Ledger</a></li>
                      <li><a class="" href="<?php echo site_url('sale/addSOrder'); ?>">Add Sale</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('sale/viewSales'); ?>" data-placement="top" data-original-title="All Sale Orders">View Sale(s)</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('sale/addPayment'); ?>" data-placement="top" data-original-title="New Sale Payment">Add Payment</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('sale/viewPayments'); ?>" data-placement="top" data-original-title="All Sale Payments">View Payment(s)</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('sale/addReturn'); ?>" data-placement="top" data-original-title="New Sale Return (Damage Products)">Add S.Return</a></li>
                      <li><a class="tooltips" href="<?php echo site_url('sale/viewReturns'); ?>" data-placement="top" data-original-title="All Sale Returns (Damage Products)">View S.Return(s)</a></li>
                      <!-- <li><a class="" href="<?php echo site_url('sale/viewCSheet'); ?>">Closing Sheet</a></li> -->
                  </ul>
              </li>
           <!--    <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <i class="icon-file-alt"></i>
                      <span>Reports</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="#">Overview Chart</a></li>
                      <li><a class="" href="#">Purchase(s) Reports</a></li>
                      <li><a class="" href="#">Sale(s) Reports</a></li>
                      <li><a class="" href="#">Sale(s) By Products</a></li>
                      <li><a class="" href="#">Sale(s) By Date</a></li>
                  </ul>
              </li> -->
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                     <i class="icon-cogs"></i>
                      <span>Settings</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="<?php echo site_url('settings/viewCDetails'); ?>">Company Details</a></li>
                      <li><a class="" href="<?php echo site_url('settings/viewCPassword'); ?>">Change Password</a></li>
                      <li><a class="" href="<?php echo site_url('settings/reportSetting'); ?>">Report Setting</a></li>
                      <li><a class="" href="<?php echo site_url('settings/viewBackups'); ?>">Backup Database</a></li>
                  </ul>
              </li>
          </ul>
         <!-- END SIDEBAR MENU -->
      </div>
      </div>
      <!-- END SIDEBAR -->