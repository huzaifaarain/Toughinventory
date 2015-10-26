<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Purchase extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->dlib->checkLogin();
        //echo $this->itemfordt(2);
    }
    public function addSupplier() {
        if ($_POST) {
            $data       = (array) $_POST;
            $data['id'] = $this->dbo->autoID('suppliers');
            $check      = $this->dbo->saveSupplier($data);
            if ($check) {
                $this->session->set_flashdata('msg', "Saved");
                redirect(current_url(), 'refresh');
            } //$check
            else {
                $this->session->set_flashdata('msg', "Error Occured");
                redirect(current_url(), 'refresh');
            }
        } //$_POST
        else {
            $this->load->view('header', array(
                'title' => "Add Supplier"
            ));
            $this->load->view('purchase/add_Supplier');
            $this->load->view('footer');
        }
    }
    public function ajaxgetsuppliers() {
        $this->datatables->select('id,name,company,address,phone,email,obalance')->from('suppliers');
        $this->datatables->add_column('Actions', '<div class="btn-group">

            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">

            Action(s) <span class="caret"></span>

            </button>

            <ul class="dropdown-menu">

            <li><a href="' . site_url('purchase/editSupplier/$1') . '">Edit</a></li>

            <li><a onclick="btnDelete();" href="' . site_url('purchase/deleteSupplier/$1') . '">Delete</a></li>
            <li><a onclick=\'windowOpen("'. site_url('purchase/supplierLedger?supplier_id=$1&from=&to=') .'");\' href=>View Ledger</a></li>

            </ul></div>', 'id');
        echo $this->datatables->generate();
    }
    public function viewSuppliers() {
        $this->load->view('header', array(
            'title' => "View Suppliers"
        ));
        $this->load->view('purchase/view_Supplier');
        $this->load->view('footer');
    }
    public function editSupplier($id) {
        if ($_POST) {
            $data  = (array) $_POST;
            $check = $this->dbo->saveSupplier($data);
            if ($check) {
                $this->session->set_flashdata('msg', "Updated");
                redirect(site_url('purchase/viewSuppliers'), 'refresh');
            } //$check
            else {
                $this->session->set_flashdata('msg', "Error Occured");
                redirect(current_url(), 'refresh');
            }
        } //$_POST
        else {
            $supplier = $this->dbo->viewSuppliers(array(
                'id' => $id
            ));
            if ($supplier->num_rows() > 0) {
                $this->load->view('header', array(
                    'title' => "Edit Supplier"
                ));
                $this->load->view('purchase/edit_Supplier', array(
                    'supplier' => $supplier
                ));
                $this->load->view('footer');
            } //$supplier->num_rows() > 0
        }
    }
    public function deleteSupplier($id) {
        $this->db->delete('suppliers', array(
            'id' => $id
        ));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', "Deleted");
            redirect(site_url('purchase/viewSuppliers'), 'refresh');
        } //$this->db->affected_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Error Occured");
            redirect(site_url('purchase/viewSuppliers'), 'refresh');
        }
    }
    public function supplierLedger() {
        if ($_GET) {
            if ($_GET['supplier_id'] == "all") {
                $this->allsupplierledger();
            } //$_GET['supplier_id'] == "all"
            else {
                $this->singleAccountledger($_GET['supplier_id']);
            }
        } //$_GET
        else {
            $supplier = $this->dbo->viewSuppliers(null);
            $this->load->view('header', array(
                'title' => "Accounts Ledger"
            ));
            $this->load->view('purchase/view_ledger', array(
                'suppliers' => $supplier
            ));
            $this->load->view('footer');
        }
    }
    public function allsupplierledger() {
        $this->db->select('
    
            suppliers.name Name,
    
            COALESCE( suppliers.obalance , 0 ) as OppBalance,
    
            COALESCE( purchase.amount, 0 ) as PayableDebit,
    
            COALESCE( sum(p_payments.amount), 0 ) as PayableCredit,
    
            ', FALSE);
        $this->db->from('suppliers');
        $purchase = "( Select p.supplier_id,sum(pi.quantity*pi.unit_price) as amount from purchases p join purchase_items pi on p.id = pi.purchase_id";
        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $purchase .= " where p.date >= '{$_GET['from']}' and p.date <= '{$_GET['to']}'";
        } //!empty($_GET['from']) && !empty($_GET['to'])
        $purchase .= " group by p.supplier_id ) purchase";
        $this->db->join($purchase, 'purchase.supplier_id = suppliers.id', 'left');
        $this->db->join("p_payments", 'p_payments.supplier_id = suppliers.id', 'left');
        $this->db->group_by('suppliers.id');
        $resultSet = $this->db->get();
        $this->load->view('reports/rp_header', array(
            'title' => "Accounts Ledger"
        ));
        $this->load->view('reports/rp_accountLedger', array(
            'resultSet' => $resultSet
        ));
        $this->load->view('reports/rp_footer');
    }
    public function singleAccountledger($supplier_id) {
        $from           = ((isset($_GET['from']) && !empty($_GET['from'])) ? $_GET['from'] : false);
        $to             = ((isset($_GET['to']) && !empty($_GET['to'])) ? $_GET['to'] : false);
        // Accounts
        $supplier       = $this->db->select('*')->from('suppliers')->where(array(
            'id' => $supplier_id
        ))->get();
        // Purchase
        $purchase_query = "purchases.date,
    
                GROUP_CONCAT(
    
                    CONCAT(
    
                        products.name,
    
                        '(',
    
                        purchase_items.quantity,')',
    
                        '(',purchase_items.unit_price,')',
    
                        '(',purchase_items.quantity * purchase_items.unit_price,')') SEPARATOR '<br>') as idetail,
    
                        sum(purchase_items.quantity * purchase_items.unit_price) as totalamount";
        $this->db->select($purchase_query, FALSE)->from('purchases')->join('purchase_items', 'purchase_items.purchase_id = purchases.id', 'left')->join('products', 'products.id = purchase_items.product_id', 'left')->where(array(
            'purchases.supplier_id' => $supplier_id
        ));
        if ($from && $to) {
            $this->db->where(array(
                'purchases.date >=' => $from,
                'purchases.date <=' => $to
            ));
        } //$from && $to
        $this->db->group_by('purchases.date');
        $purchases = $this->db->get();
        // Purchase Payments
        $this->db->select()->from('p_payments')->where(array(
            'p_payments.supplier_id' => $supplier_id
        ));
        if ($from && $to) {
            $this->db->where(array(
                'p_payments.date >=' => $from,
                'p_payments.date <=' => $to
            ));
        } //$from && $to
        $pamounts          = $this->db->get();
        $data['supplier']  = $supplier;
        $data['purchases'] = $purchases;
        $data['pamounts']  = $pamounts;
        $this->load->view('reports/rp_header', array(
            'title' => "Account Ledger"
        ));
        $this->load->view('reports/rp_saccountledger', $data);
        $this->load->view('reports/rp_footer');
    }
    public function addPOrder() {
        $data['suppliers'] = $this->dbo->viewSuppliers(null);
        $this->load->view('header', array(
            'title' => "Add Purchase Order"
        ));
        $this->load->view('purchase/add_PurchaseOrder', $data);
        $this->load->view('footer');
    }
    public function savePOrder() {
        $singleRow      = $this->input->post('sRow');
        $purchase_items = $this->input->post('mRow');
        $id             = $this->input->post('id');
        $check          = $this->dbo->savePurchaseOrder($singleRow, $purchase_items, $id);
        $data           = array();
        if ($check) {
            $data['result'] = true;
            $data['_id']    = $this->dbo->autoID('purchases');
        } //$check
        else {
            $data['result'] = false;
        }
        echo json_encode($data);
    }
    public function viewPurchases() {
        $data['Suppliers'] = $this->dbo->viewSuppliers(null);
        $this->load->view('header', array(
            'title' => "View Purchases"
        ));
        $this->load->view('purchase/view_porders', $data);
        $this->load->view('footer');
    }
    public function ajaxgetpurchases() {
        $this->datatables->select("purchases.id,suppliers.name, date,reference_no,note,tax_per, 
    
            GROUP_CONCAT(CONCAT(products.name,'(',purchase_items.quantity,')') SEPARATOR '<br>') as idetail,
    
            sum(purchase_items.quantity * purchase_items.unit_price) as totalamount", FALSE)->from('purchases')->join('suppliers', 'suppliers.id = purchases.supplier_id', 'LEFT JOIN')->join('purchase_items', 'purchase_items.purchase_id = purchases.id', 'LEFT JOIN')->join('products', 'products.id = purchase_items.product_id', 'LEFT JOIN');
        $this->datatables->group_by('purchases.id');
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->datatables->where('purchases.id =' . $_GET['id']);
        } //isset($_GET['id']) && !empty($_GET['id'])
        if (isset($_GET['supplier_id']) && !empty($_GET['supplier_id'])) {
            $this->datatables->where("purchases.supplier_id ='{$_GET['supplier_id']}'");
        } //isset($_GET['supplier_id']) && !empty($_GET['supplier_id'])
        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
            $this->datatables->where("purchases.date >= '{$_GET['start_date']}'");
        } //isset($_GET['start_date']) && !empty($_GET['start_date'])
        if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
            $this->datatables->where("purchases.date <= '{$_GET['end_date']}'");
        } //isset($_GET['end_date']) && !empty($_GET['end_date'])
        $this->datatables->add_column("Actions", "<div class='btn-group'>
    
            <button data-toggle='dropdown' class='btn btn-primary dropdown-toggle'>
    
            Action(s) <span class='caret'></span>
    
            </button>
    
            <ul class='dropdown-menu'>
    
            <li><a href='" . site_url('purchase/editPurchase/$1') . "'>Edit</a></li>
    
            <li><a onclick='btnDelete();' href='" . site_url('purchase/deletePurchase/$1') . "'>Delete</a></li>
            <li><a onclick=\"windowOpen('".site_url('purchase/printPO/$1')."');\" href='#'>Print PO</a></li>
    
            </ul></div>", "purchases.id");
        echo $this->datatables->generate();
        // echo $this->db->last_query();
    }
    public function editPurchase($id) {
        $purchaseData = $this->dbo->viewPurchases(array(
            'id' => $id
        ));
        if ($purchaseData->num_rows() > 0) {
            $data['Suppliers']    = $this->dbo->viewSuppliers(null);
            $data['purchaseData'] = $purchaseData;
            $this->load->view('header', array(
                'title' => "Edit Purchases"
            ));
            $this->load->view('purchase/edit_purchase', $data);
            $this->load->view('footer');
        } //$purchaseData->num_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Invalid Entry");
            redirect(site_url('purchase/viewPurchases'), 'refresh');
        }
    }
    public function deletePurchase($id) {
        $this->db->delete('purchases', array(
            'id' => $id
        ));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', "Deleted !");
            redirect(site_url('purchase/viewPurchases'), 'refresh');
        } //$this->db->affected_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Invalid Entry");
            redirect(site_url('purchase/viewPurchases'), 'refresh');
        }
    }
    public function itemfordt($id) {
        $result = $this->dbo->viewPurchaseItems(array(
            'purchase_id' => $id
        ))->result();
        $string = "";
        foreach ($result as $items) {
            $string .= $items->product_name . "(Q = " . $items->quantity . ")" . "(Unit Price = " . $items->unit_price . ")</br>";
        } //$result as $items
        return $string;
    }
    // Purchase Order Above
    public function addPPayment() {
        if ($_POST) {
            $data       = (array) $_POST;
            $data['id'] = $this->dbo->autoID('p_payments');
            $check      = $this->dbo->savePPayment($data);
            if ($check) {
                $this->session->set_flashdata('msg', "Saved");
                redirect(site_url('purchase/viewPPayments'), 'refresh');
            } //$check
            else {
                $this->session->set_flashdata('msg', "Error Occured !");
                redirect(site_url('purchase/viewPPayments'), 'refresh');
            }
        } //$_POST
        else {
            $data['Suppliers'] = $this->dbo->viewSuppliers(null);
            $this->load->view('header', array(
                'title' => "Add Purchase Payment"
            ));
            $this->load->view('purchase/add_ppayment', $data);
            $this->load->view('footer');
        }
    }
    public function viewPPayments() {
        $data['Suppliers'] = $this->dbo->viewSuppliers(null);
        $this->load->view('header', array(
            'title' => "View Purchase Payments"
        ));
        $this->load->view('purchase/view_ppayment', $data);
        $this->load->view('footer');
    }
    public function ajaxgetppayments() {
        $this->datatables->select('p_payments.id,suppliers.name as supplier_name,p_payments.reference_po,p_payments.date,p_payments.amount,p_payments.note')->from('p_payments');
        $this->datatables->join('suppliers', 'suppliers.id=p_payments.supplier_id', 'left');
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->datatables->where('p_payments.id =' . $_GET['id']);
        } //isset($_GET['id']) && !empty($_GET['id'])
        if (isset($_GET['supplier_id']) && !empty($_GET['supplier_id'])) {
            $this->datatables->where("p_payments.supplier_id ='{$_GET['supplier_id']}'");
        } //isset($_GET['supplier_id']) && !empty($_GET['supplier_id'])
        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
            $this->datatables->where("p_payments.date >= '{$_GET['start_date']}'");
        } //isset($_GET['start_date']) && !empty($_GET['start_date'])
        if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
            $this->datatables->where("p_payments.date <= '{$_GET['end_date']}'");
        } //isset($_GET['end_date']) && !empty($_GET['end_date'])
        $this->datatables->add_column('Actions', '<div class="btn-group">
    
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
    
            Action(s) <span class="caret"></span>
    
            </button>
    
            <ul class="dropdown-menu">
    
            <li><a href="' . site_url('purchase/editPPayment/$1') . '">Edit</a></li>
    
            <li><a onclick="btnDelete();" href="' . site_url('purchase/deletePPayment/$1') . '">Delete</a></li>
    
            </ul></div>', 'p_payments.id');
        echo $this->datatables->generate();
    }
    public function editPPayment($id) {
        if ($_POST) {
            $data  = (array) $_POST;
            $check = $this->dbo->savePPayment($data);
            if ($check) {
                $this->session->set_flashdata('msg', "Updated");
                redirect(site_url('purchase/viewPPayments'), 'refresh');
            } //$check
            else {
                $this->session->set_flashdata('msg', "Error Occured !");
                redirect(site_url('purchase/viewPPayments'), 'refresh');
            }
        } //$_POST
        else {
            $ppayment = $this->dbo->viewPPayments(array(
                'id' => $id
            ));
            if ($ppayment->num_rows() > 0) {
                $data['suppliers']   = $this->dbo->viewSuppliers(null);
                $data['paymentData'] = $ppayment;
                $this->load->view('header', array(
                    'title' => "Edit Purchase Payment"
                ));
                $this->load->view('purchase/edit_ppayment', $data);
                $this->load->view('footer');
            } //$ppayment->num_rows() > 0
        }
    }
    public function deletePPayment($id) {
        $this->db->delete('p_payments', array(
            'id' => $id
        ));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', "Deleted !");
            redirect(site_url('purchase/viewPPayments'), 'refresh');
        } //$this->db->affected_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Invalid Entry");
            redirect(site_url('purchase/viewPPayments'), 'refresh');
        }
    }
    public function addPReturn() {
        $data['suppliers'] = $this->dbo->viewSuppliers(null);
        $this->load->view('header', array(
            'title' => "Add Purchase Return"
        ));
        $this->load->view('purchase/add_PurchaseReturn', $data);
        $this->load->view('footer');
    }
    public function savePReturn() {
        $singleRow      = $this->input->post('sRow');
        $purchase_items = $this->input->post('mRow');
        $id             = $this->input->post('recordid');
        $check          = $this->dbo->savePurchaseReturn($singleRow, $purchase_items, $id);
        $data           = array();
        if ($check) {
            $data['result'] = true;
        } //$check
        else {
            $data['result'] = false;
        }
        echo json_encode($data);
    }
    public function viewReturns() {
        $data['Suppliers'] = $this->dbo->viewSuppliers(null);
        $this->load->view('header', array(
            'title' => "View Purchases"
        ));
        $this->load->view('purchase/view_returns', $data);
        $this->load->view('footer');
    }
    public function ajaxgetreturns() {
        $this->datatables->select("purchases_r.id,suppliers.name, date,reference_no,note,total_tax, 
    
            GROUP_CONCAT(CONCAT(products.name,'(',purchaser_items.quantity,')') SEPARATOR '<br>') as idetail,
    
            sum(purchaser_items.quantity * purchaser_items.unit_price) as totalamount", FALSE)->from('purchases_r')->join('suppliers', 'suppliers.id = purchases_r.supplier_id', 'left')->join('purchaser_items', 'purchaser_items.purchase_id = purchases_r.id', 'left')->join('products', 'products.id = purchaser_items.product_id', 'left');
        $this->datatables->group_by('purchases_r.id');
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->datatables->where('purchases_r.id =' . $_GET['id']);
        } //isset($_GET['id']) && !empty($_GET['id'])
        if (isset($_GET['supplier_id']) && !empty($_GET['supplier_id'])) {
            $this->datatables->where("purchases_r.supplier_id ='{$_GET['supplier_id']}'");
        } //isset($_GET['supplier_id']) && !empty($_GET['supplier_id'])
        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
            $this->datatables->where("purchases_r.date >= '{$_GET['start_date']}'");
        } //isset($_GET['start_date']) && !empty($_GET['start_date'])
        if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
            $this->datatables->where("purchases_r.date <= '{$_GET['start_date']}'");
        } //isset($_GET['end_date']) && !empty($_GET['end_date'])
        $this->datatables->add_column('Actions', '<div class="btn-group">
    
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
    
            Action(s) <span class="caret"></span>
    
            </button>
    
            <ul class="dropdown-menu">
    
            <li><a href="' . site_url('purchase/editReturn/$1') . '">Edit</a></li>
    
            <li><a onclick="btnDelete();" href="' . site_url('purchase/deleteReturn/$1') . '">Delete</a></li>
            <li><a onclick=\'windowOpen("'.site_url("purchase/printPReturn/$1").'");\' href="#">Print</a></li>
            
            </ul></div>', 'purchases_r.id');
        echo $this->datatables->generate();
    }
    public function editReturn($id) {
        $purchaseData = $this->dbo->viewReturns(array(
            'id' => $id
        ));
        if ($purchaseData->num_rows() > 0) {
            $data['Suppliers']    = $this->dbo->viewSuppliers(null);
            $data['purchaseData'] = $purchaseData;
            $this->load->view('header', array(
                'title' => "Edit Purchase Return"
            ));
            $this->load->view('purchase/edit_return', $data);
            $this->load->view('footer');
        } //$purchaseData->num_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Invalid Entry");
            redirect(site_url('purchase/viewReturns'), 'refresh');
        }
    }
    public function deleteReturn($id) {
        $this->db->delete('purchases_r', array(
            'id' => $id
        ));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', "Deleted");
            redirect(site_url('purchase/viewReturns'), 'refresh');
        } //$this->db->affected_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Error Occured");
            redirect(site_url('purchase/viewReturns'), 'refresh');
        }
    }
    public function viewCSheet() {
        $this->load->view('header', array(
            'title' => "Closing Sheets"
        ));
        $this->load->view('purchase/view_csheet');
        $this->load->view('footer');
    }
    public function printPO($id)
    {
        $this->db->select("purchases.id,suppliers.name, date,reference_no,note,tax_per, 
    
            GROUP_CONCAT(CONCAT('<tr><td>',products.name,'</td><td>',purchase_items.quantity,'</td><td>',purchase_items.unit_price,'</td><td>',purchase_items.quantity*purchase_items.unit_price,'</td></tr>') SEPARATOR '') as idetail,
    
            sum(purchase_items.quantity * purchase_items.unit_price) as totalamount", FALSE)
          ->from('purchases')
          ->join('suppliers', 'suppliers.id = purchases.supplier_id', 'LEFT JOIN')
          ->join('purchase_items', 'purchase_items.purchase_id = purchases.id', 'LEFT JOIN')
          ->join('products', 'products.id = purchase_items.product_id', 'LEFT JOIN');
        $this->db->where('purchases.id', $id);
        $resultSet = $this->db->get();
        if ($resultSet->num_rows() == 1) 
        {
            $this->load->view('reports/rp_header', array(
            'title' => "Purchase Order"
            ));
            $this->load->view('reports/rp_purchase', array(
                'resultSet' => $resultSet->row()
            ));
            $this->load->view('reports/rp_footer');
        }
        else
        {
            $this->session->set_flashdata('msg', "Invalid Entry !");
            redirect(site_url('purchase/viewPurchases'), 'refresh');
        }
    }
    public function printPReturn($id)
    {
        $this->db->select("purchases_r.id,suppliers.name, date,reference_no,note,total_tax, 
    
            GROUP_CONCAT(CONCAT('<tr><td>',products.name,'</td><td>',purchaser_items.quantity,'</td><td>',purchaser_items.unit_price,'</td><td>',purchaser_items.quantity*purchaser_items.unit_price,'</td></tr>') SEPARATOR '') as idetail,
    
            sum(purchaser_items.quantity * purchaser_items.unit_price) as totalamount", FALSE)
          ->from('purchases_r')
          ->join('suppliers', 'suppliers.id = purchases_r.supplier_id')
          ->join('purchaser_items', 'purchaser_items.purchase_id = purchases_r.id')
          ->join('products', 'products.id = purchaser_items.product_id');
        $this->db->where('purchases_r.id', $id);
        $resultSet = $this->db->get();
        if ($resultSet->num_rows() == 1) 
        {
            $this->load->view('reports/rp_header', array(
            'title' => "Purchase Return"
            ));
            $this->load->view('reports/rp_purchasereturn', array(
                'resultSet' => $resultSet->row()
            ));
            $this->load->view('reports/rp_footer');
        }
        else
        {
            $this->session->set_flashdata('msg', "Invalid Entry !");
            redirect(site_url('purchase/viewReturns'), 'refresh');
        }
    }
}
/* End of file purchase.php */
/* Location: ./application/controllers/purchase.php */
