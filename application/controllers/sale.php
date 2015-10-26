<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**

* 

*/
class Sale extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->dlib->checkLogin();
    }
    public function addCustomer() {
        if ($_POST) {
            $data       = (array) $_POST;
            $data['id'] = $this->dbo->autoID('customers');
            $check      = $this->dbo->saveCustomer($data);
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
                'title' => "Add Client"
            ));
            $this->load->view('sale/add_client');
            $this->load->view('footer');
        }
    }
    public function ajaxgetcustomers() {
        $this->datatables->select('id,name,company,address,phone,email,obalance')->from('customers');
        $this->datatables->add_column('Actions', '<div class="btn-group">

			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">

			Action(s) <span class="caret"></span>

			</button>

			<ul class="dropdown-menu">

			<li><a href="' . site_url('sale/editCustomer/$1') . '">Edit</a></li>

			<li><a onclick="btnDelete();" href="' . site_url('sale/deleteCustomer/$1') . '">Delete</a></li>

			</ul></div>', 'id');
        echo $this->datatables->generate();
    }
    public function viewCustomers() {
        $this->load->view('header', array(
            'title' => "View Customers"
        ));
        $this->load->view('sale/view_clients');
        $this->load->view('footer');
    }
    public function editCustomer($id) {
        if ($_POST) {
            $data  = (array) $_POST;
            $check = $this->dbo->saveCustomer($data);
            if ($check) {
                $this->session->set_flashdata('msg', "Updated");
                redirect(site_url('sale/viewCustomers'), 'refresh');
            } //$check
            else {
                $this->session->set_flashdata('msg', "Error Occured");
                redirect(current_url(), 'refresh');
            }
        } //$_POST
        else {
            $customers = $this->dbo->viewCustomers(array(
                'id' => $id
            ));
            if ($customers->num_rows() > 0) {
                $this->load->view('header', array(
                    'title' => "Edit Customer"
                ));
                $this->load->view('sale/edit_client', array(
                    'customer' => $customers
                ));
                $this->load->view('footer');
            } //$customers->num_rows() > 0
        }
    }
    public function deleteCustomer($id) {
        $this->db->delete('customers', array(
            'id' => $id
        ));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', "Deleted");
            redirect(site_url('sale/viewCustomers'), 'refresh');
        } //$this->db->affected_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Error Occured");
            redirect(site_url('sale/viewCustomers'), 'refresh');
        }
    }
    public function customerLedger() {
        if ($_GET) {
            if ($_GET['customer_id'] == "all") {
                $this->allsupplierledger();
            } //$_GET['customer_id'] == "all"
            else {
                $this->singleAccountledger($_GET['customer_id']);
            }
        } //$_GET
        else {
            $customers = $this->dbo->viewCustomers(null);
            $this->load->view('header', array(
                'title' => "Customer Ledger"
            ));
            $this->load->view('sale/view_ledger', array(
                'customers' => $customers
            ));
            $this->load->view('footer');
        }
    }
    public function allsupplierledger($from = null, $to = null) {
        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $from = $_GET['from'];
            $to   = $_GET['to'];
        } //!empty($_GET['from']) && !empty($_GET['to'])
        $this->db->select('

			customers.name Name,

			COALESCE( customers.obalance , 0 ) as OppBalance,

			COALESCE( sale.amount, 0 ) as Debit,

			COALESCE( sum(s_payments.amount), 0 ) as Credit,

			', FALSE);
        $this->db->from('customers');
        $sale = "( Select s.customer_id,sum(si.quantity*si.unit_price-(si.scheme+si.comission)) - (sum(si.quantity*si.unit_price-(si.scheme+si.comission)) / 100 * s.total_tax) as amount from sales s join sale_items si on s.id = si.sale_id";
        if (!empty($from) && !empty($to)) {
            $sale .= " where s.date >= '{$from}' and s.date <= '{$to}'";
        } //!empty($from) && !empty($to)
        $sale .= " group by s.customer_id ) sale";
        $this->db->join($sale, 'sale.customer_id = customers.id', 'left');
        $this->db->join("s_payments", 's_payments.customer_id = customers.id', 'left');
        $this->db->group_by('customers.id');
        $resultSet = $this->db->get();
        $this->load->view('reports/rp_header', array(
            'title' => "Customers Ledger"
        ));
        $this->load->view('reports/rp_customerLedger', array(
            'resultSet' => $resultSet
        ));
        $this->load->view('reports/rp_footer');
    }
    public function singleAccountledger($customer_id) {
        $from       = ((isset($_GET['from']) && !empty($_GET['from'])) ? $_GET['from'] : false);
        $to         = ((isset($_GET['to']) && !empty($_GET['to'])) ? $_GET['to'] : false);
        // Customers
        $customer   = $this->db->select('*')->from('customers')->where(array(
            'id' => $customer_id
        ))->get();
        // Sale
        $sale_query = "sales.date,

				GROUP_CONCAT(

					CONCAT(

						products.name,

						'(',

						sale_items.quantity,

						')','(',sale_items.unit_price,')'

						,'(',sale_items.scheme,')'

						,')',sale_items.comission,')'

						,'(',((sale_items.quantity*sale_items.unit_price)-(sale_items.scheme+sale_items.comission)),')') SEPARATOR '<br>') as idetail,

						sum(((sale_items.quantity*sale_items.unit_price)-(sale_items.scheme+sale_items.comission))) - (sum(((sale_items.quantity*sale_items.unit_price)-(sale_items.scheme+sale_items.comission))) / 100 * sales.total_tax) as totalamount";
        $this->db->select($sale_query, FALSE)->from('sales')->join('sale_items', 'sale_items.sale_id = sales.id', 'left')->join('products', 'products.id = sale_items.product_id', 'left')->where(array(
            'sales.customer_id' => $customer_id
        ));
        if ($from && $to) {
            $this->db->where(array(
                'sales.date >=' => $from,
                'sales.date <=' => $to
            ));
        } //$from && $to
        $this->db->group_by('sales.date');
        $sales = $this->db->get();
        // Sale Payments
        $this->db->select()->from('s_payments')->where(array(
            's_payments.customer_id' => $customer_id
        ));
        if ($from && $to) {
            $this->db->where(array(
                's_payments.date >=' => $from,
                's_payments.date <=' => $to
            ));
        } //$from && $to
        $amounts          = $this->db->get();
        $data['customer'] = $customer;
        $data['sales']    = $sales;
        $data['amounts']  = $amounts;
        $this->load->view('reports/rp_header', array(
            'title' => "Account Ledger"
        ));
        $this->load->view('reports/rp_scusttomerLedger', $data);
        $this->load->view('reports/rp_footer');
    }
    public function addSOrder() {
        $data['customers'] = $this->dbo->viewCustomers();
        $this->load->view('header', array(
            'title' => "Add Sale Order"
        ));
        $this->load->view('sale/add_saleorder', $data);
        $this->load->view('footer');
    }
    public function saveSale() {
        $singleRow  = $this->input->post('sRow');
        $sale_items = $this->input->post('mRow');
        $id         = $this->input->post('id');
        $check      = $this->dbo->saveSale($singleRow, $sale_items, $id);
        $data       = array();
        if ($check) {
            $data['result'] = true;
        } //$check
        else {
            $data['result'] = false;
        }
        echo json_encode($data);
    }
    public function viewSales() {
        $data['customers'] = $this->dbo->viewCustomers(null);
        $this->load->view('header', array(
            'title' => "View Sales"
        ));
        $this->load->view('sale/view_sale', $data);
        $this->load->view('footer');
    }
    public function ajaxgetsales() {
        $this->datatables->select("sales.id,customers.name, date,reference_no,note,sales.total_tax, 

			GROUP_CONCAT(CONCAT(products.name,'(',sale_items.quantity,')'

				,'(',sale_items.unit_price,')',

				'(',sale_items.scheme,')'

				,'(',sale_items.comission,')'

				,'(',((sale_items.quantity*sale_items.unit_price)-(sale_items.scheme+sale_items.comission)),')') SEPARATOR '<br>') as idetail,

			sum(((sale_items.quantity*sale_items.unit_price)-(sale_items.scheme+sale_items.comission))) - (sum(((sale_items.quantity*sale_items.unit_price)-(sale_items.scheme+sale_items.comission))) / 100 * sales.total_tax) as totalamount", FALSE)->from('sales')->join('customers', 'customers.id = sales.customer_id', 'left')->join('sale_items', 'sale_items.sale_id = sales.id', 'left')->join('products', 'products.id = sale_items.product_id', 'left');
        $this->datatables->group_by('sales.id');
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->datatables->where('sales.id =' . $_GET['id']);
        } //isset($_GET['id']) && !empty($_GET['id'])
        if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
            $this->datatables->where("sales.customer_id ='{$_GET['customer_id']}'");
        } //isset($_GET['customer_id']) && !empty($_GET['customer_id'])
        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
            $this->datatables->where("sales.date >= '{$_GET['start_date']}'");
        } //isset($_GET['start_date']) && !empty($_GET['start_date'])
        if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
            $this->datatables->where("sales.date <= '{$_GET['end_date']}'");
        } //isset($_GET['end_date']) && !empty($_GET['end_date'])
        $this->datatables->add_column('Actions', '<div class="btn-group">

			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">

			Action(s) <span class="caret"></span>

			</button>

			<ul class="dropdown-menu">

			<li><a href="' . site_url('sale/editSale/$1') . '">Edit</a></li>

			<li><a onclick="btnDelete();" href="' . site_url('sale/deleteSale/$1') . '">Delete</a></li>

            <li><a onclick=\'windowOpen("'.site_url("sale/printSO/$1").'");\' href="#">Print</a></li>

            <li><a onclick=\'windowOpen("'.site_url("sale/printDO/$1").'");\' href="#">Print DO</a></li>

			</ul></div>', 'sales.id');
        echo $this->datatables->generate();
        // echo $this->db->last_query();
    }
    public function editSale($id) {
        $saleData = $this->dbo->viewSales(array(
            'id' => $id
        ));
        if ($saleData->num_rows() > 0) {
            $data['customers'] = $this->dbo->viewCustomers(null);
            $data['saleData']  = $saleData;
            $this->load->view('header', array(
                'title' => "Edit Sale"
            ));
            $this->load->view('sale/edit_sale', $data);
            $this->load->view('footer');
        } //$saleData->num_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Invalid Entry");
            redirect(site_url('sale/viewSales'), 'refresh');
        }
    }
    public function deleteSale($id) {
        $this->db->delete('sales', array(
            'id' => $id
        ));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', "Deleted !");
            redirect(site_url('sale/viewSales'), 'refresh');
        } //$this->db->affected_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Invalid Entry");
            redirect(site_url('sale/viewSales'), 'refresh');
        }
    }
    // Purchase Order Above
    public function addPayment() {
        if ($_POST) {
            $data       = (array) $_POST;
            $data['id'] = $this->dbo->autoID('s_payments');
            $check      = $this->dbo->saveSalePayment($data);
            if ($check) {
                $this->session->set_flashdata('msg', "Saved");
                redirect(current_url(), 'refresh');
            } //$check
            else {
                $this->session->set_flashdata('msg', "Error Occured !");
                redirect(current_url(), 'refresh');
            }
        } //$_POST
        else {
            $data['customers'] = $this->dbo->viewCustomers(null);
            $this->load->view('header', array(
                'title' => "Add Sale Payment"
            ));
            $this->load->view('sale/add_salepayment', $data);
            $this->load->view('footer');
        }
    }
    public function viewPayments() {
        $data['customers'] = $this->dbo->viewCustomers(null);
        $this->load->view('header', array(
            'title' => "View Sale Payments"
        ));
        $this->load->view('sale/view_salepayment', $data);
        $this->load->view('footer');
    }
    public function ajaxgetpayments() {
        $this->datatables->select('s_payments.id,customers.name as customer_name,s_payments.reference_so,s_payments.date,s_payments.amount,s_payments.note')->from('s_payments');
        $this->datatables->join('customers', 'customers.id = s_payments.customer_id', 'left');
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->datatables->where('s_payments.id =' . $_GET['id']);
        } //isset($_GET['id']) && !empty($_GET['id'])
        if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
            $this->datatables->where("s_payments.customer_id ='{$_GET['customer_id']}'");
        } //isset($_GET['customer_id']) && !empty($_GET['customer_id'])
        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
            $this->datatables->where("s_payments.date >= '{$_GET['start_date']}'");
        } //isset($_GET['start_date']) && !empty($_GET['start_date'])
        if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
            $this->datatables->where("s_payments.date <= '{$_GET['end_date']}'");
        } //isset($_GET['end_date']) && !empty($_GET['end_date'])
        $this->datatables->add_column('Actions', '<div class="btn-group">

			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">

			Action(s) <span class="caret"></span>

			</button>

			<ul class="dropdown-menu">

			<li><a href="' . site_url('sale/editPayment/$1') . '">Edit</a></li>

			<li><a onclick="btnDelete();" href="' . site_url('sale/deletePayment/$1') . '">Delete</a></li>

			</ul></div>', 's_payments.id');
        echo $this->datatables->generate();
    }
    public function editPayment($id) {
        if ($_POST) {
            $data  = (array) $_POST;
            $check = $this->dbo->saveSalePayment($data);
            if ($check) {
                $this->session->set_flashdata('msg', "Updated");
                redirect(site_url('sale/viewPayments'), 'refresh');
            } //$check
            else {
                $this->session->set_flashdata('msg', "Error Occured !");
                redirect(site_url('sale/viewPayments'), 'refresh');
            }
        } //$_POST
        else {
            $payment = $this->dbo->viewSalePayments(array(
                'id' => $id
            ));
            if ($payment->num_rows() > 0) {
                $data['customers']   = $this->dbo->viewCustomers(null);
                $data['paymentData'] = $payment;
                $this->load->view('header', array(
                    'title' => "Edit Sale Payment"
                ));
                $this->load->view('sale/edit_salepayment', $data);
                $this->load->view('footer');
            } //$payment->num_rows() > 0
        }
    }
    public function deletePayment($id) {
        $this->db->delete('s_payments', array(
            'id' => $id
        ));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', "Deleted !");
            redirect(site_url('sale/viewPayments'), 'refresh');
        } //$this->db->affected_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Invalid Entry");
            redirect(site_url('sale/viewPayments'), 'refresh');
        }
    }
    public function addReturn() {
        $data['customers'] = $this->dbo->viewCustomers(null);
        $this->load->view('header', array(
            'title' => "Add Sale Return"
        ));
        $this->load->view('sale/add_salereturn', $data);
        $this->load->view('footer');
    }
    public function saveReturn() {
        $singleRow = $this->input->post('sRow');
        $items     = $this->input->post('mRow');
        $id        = $this->input->post('id');
        $check     = $this->dbo->saveSaleReturn($singleRow, $items, $id);
        $data      = array();
        if ($check) {
            $data['result'] = true;
        } //$check
        else {
            $data['result'] = false;
        }
        echo json_encode($data);
    }
    public function viewReturns() {
        $data['customers'] = $this->dbo->viewCustomers(null);
        $this->load->view('header', array(
            'title' => "View Sale Returns"
        ));
        $this->load->view('sale/view_salereturns', $data);
        $this->load->view('footer');
    }
    public function ajaxgetreturns() {
        $this->datatables->select("sales_r.id,customers.name, date,reference_no,note, 

			GROUP_CONCAT(CONCAT(products.name,'(',saler_items.quantity,')') SEPARATOR '<br>') as idetail", FALSE)->from('sales_r')->join('customers', 'customers.id = sales_r.customer_id', 'left')->join('saler_items', 'saler_items.sale_id = sales_r.id', 'left')->join('products', 'products.id = saler_items.product_id', 'left');
        $this->datatables->group_by('sales_r.id');
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->datatables->where('sales_r.id =' . $_GET['id']);
        } //isset($_GET['id']) && !empty($_GET['id'])
        if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
            $this->datatables->where("sales_r.customer_id ='{$_GET['customer_id']}'");
        } //isset($_GET['customer_id']) && !empty($_GET['customer_id'])
        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
            $this->datatables->where("sales_r.date >= '{$_GET['start_date']}'");
        } //isset($_GET['start_date']) && !empty($_GET['start_date'])
        if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
            $this->datatables->where("sales_r.date <= '{$_GET['end_date']}'");
        } //isset($_GET['end_date']) && !empty($_GET['end_date'])
        $this->datatables->add_column('Actions', '<div class="btn-group">

			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">

			Action(s) <span class="caret"></span>

			</button>

			<ul class="dropdown-menu">

			<li><a href="' . site_url('sale/editReturn/$1') . '">Edit</a></li>

			<li><a onclick="btnDelete();" href="' . site_url('sale/deleteReturn/$1') . '">Delete</a></li>

            <li><a onclick=\'windowOpen("'.site_url("sale/printSReturn/$1").'");\' href="#">Print</a></li>

			</ul></div>', 'sales_r.id');
        echo $this->datatables->generate();
    }
    public function editReturn($id) {
        $saleData = $this->dbo->viewSaleReturns(array(
            'id' => $id
        ));
        if ($saleData->num_rows() > 0) {
            $data['customers'] = $this->dbo->viewCustomers(null);
            $data['saleData']  = $saleData;
            $this->load->view('header', array(
                'title' => "Edit Sale Return"
            ));
            $this->load->view('sale/edit_salereturn', $data);
            $this->load->view('footer');
        } //$saleData->num_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Invalid Entry");
            redirect(site_url('sale/viewReturns'), 'refresh');
        }
    }
    public function deleteReturn($id) {
        $this->db->delete('sales_r', array(
            'id' => $id
        ));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', "Deleted");
            redirect(site_url('sale/viewReturns'), 'refresh');
        } //$this->db->affected_rows() > 0
        else {
            $this->session->set_flashdata('msg', "Error Occured");
            redirect(site_url('sale/viewReturns'), 'refresh');
        }
    }
    public function viewCSheet() {
        $this->load->view('header', array(
            'title' => "Closing Sheets"
        ));
        $this->load->view('sale/view_csheet');
        $this->load->view('footer');
    }
    public function printSO($id)
    {
        $this->db->select("sales.id,customers.name, date,reference_no,note,total_tax, 
    
            GROUP_CONCAT(CONCAT('<tr><td>',products.name,'</td><td>',sale_items.quantity,'</td><td>',sale_items.unit_price,'</td><td>',sale_items.scheme,'</td><td>',sale_items.comission,'</td><td>',sale_items.quantity*sale_items.unit_price-(sale_items.scheme+sale_items.comission),'</td></tr>') SEPARATOR '') as idetail,
    
            sum(sale_items.quantity * sale_items.unit_price - (sale_items.scheme+sale_items.comission)) as totalamount", FALSE)
          ->from('sales')
          ->join('customers', 'customers.id = sales.customer_id')
          ->join('sale_items', 'sale_items.sale_id = sales.id')
          ->join('products', 'products.id = sale_items.product_id');
        $this->db->where('sales.id', $id);
        $resultSet = $this->db->get();
        if ($resultSet->num_rows() == 1) 
        {
            $this->load->view('reports/rp_header', array(
            'title' => "Sale Order"
            ));
            $this->load->view('reports/rp_sale', array(
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
    public function printSReturn($id)
    {
        $this->db->select("sales_r.id,customers.name, date,reference_no,note, 
    
            GROUP_CONCAT(CONCAT('<tr><td>',products.name,'</td><td>',saler_items.quantity,'</td></tr>') SEPARATOR '') as idetail,
            
            ", FALSE)
          ->from('sales_r')
          ->join('customers', 'customers.id = sales_r.customer_id')
          ->join('saler_items', 'saler_items.sale_id = sales_r.id')
          ->join('products', 'products.id = saler_items.product_id');
        $this->db->where('sales_r.id', $id);
        $resultSet = $this->db->get();
        if ($resultSet->num_rows() == 1) 
        {
            $this->load->view('reports/rp_header', array(
            'title' => "Sale Return"
            ));
            $this->load->view('reports/rp_salereturn', array(
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
/* End of file sale.php */
/* Location: ./application/controllers/sale.php */