<?php
if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );
/**

* 

*/
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->dlib->checkLogin();
    }
    public function index() {
        date_default_timezone_set( "Asia/Karachi" );
        $start_date    = date( "Y-m-01" );
        $end_date      = date( "Y-m-t" );
        $purchaseArray = array();
        $saleArray     = array();
        $pPaidArray    = array();
        $sRecArray     = array();
        for ( $i = 1; $i <= date( 't' ); $i++ ) {
            array_push( $purchaseArray, $this->curentMonthPurchase( date( "Y-m-" . $i ) ) );
            array_push( $saleArray, $this->curentMonthSale( date( "Y-m-" . $i ) ) );
            array_push( $pPaidArray, $this->curentMonthPaid( date( "Y-m-" . $i ) ) );
            array_push( $sRecArray, $this->curentMonthRec( date( "Y-m-" . $i ) ) );
        } //$i = 1; $i <= date( 't' ); $i++
        $data['slchart']       = $this->stockledgerChart( $start_date, $end_date );
        $data['purchaseArray'] = $purchaseArray;
        $data['saleArray']     = $saleArray;
        $data['pPaidArray']    = $pPaidArray;
        $data['sRecArray']     = $sRecArray;
        $data['highCustomers'] = $this->highCustomers();
        $data['highSuppliers'] = $this->highSuppliers();
        $data['overallStatus'] = $this->overallStatus();
        $data['qLinksData'] = $this->qLinksData();
        $this->load->view( 'header', array(
             'title' => "Dashboard" 
        ) );
        $this->load->view( 'dboard/body', $data );
        $this->load->view( 'footer' );
    }
    public function stockledgerChart( $start_date, $end_date ) {
        $pp = "( SELECT pi.product_id, SUM( pi.quantity ) purchasedQty from purchases p JOIN purchase_items pi on p.id = pi.purchase_id 

		                         group by pi.product_id ) PCosts";
        $sp = "( SELECT si.product_id, SUM( si.quantity ) soldQty from sales s JOIN sale_items si on s.id = si.sale_id 

		                       group by si.product_id ) PSales";
        $this->db->select( "p.name as Name,

		                        COALESCE( PCosts.purchasedQty - PSales.soldQty ,PCosts.purchasedQty,0) as Avail ", FALSE )->from( 'products p', FALSE )->join( $sp, 'p.id = PSales.product_id', 'left' )->join( $pp, 'p.id = PCosts.product_id', 'left' );
        $this->db->group_by( 'p.id' );
        $this->db->order_by( 'Avail', 'asc' );
        $this->db->limit( 10 );
        $resultSet = $this->db->get();
        return $resultSet;
    }
    public function curentMonthPurchase( $date ) {
        $this->db->select( '

			COALESCE( sum(purchase_items.quantity*purchase_items.unit_price), 0) as amount

			', FALSE );
        $this->db->from( 'purchases' );
        $this->db->join( 'purchase_items', 'purchase_items.purchase_id = purchases.id', 'left' );
        $this->db->where( 'purchases.date', $date );
        $result = $this->db->get();
        return $result->row()->amount;
    }
    public function curentMonthSale( $date ) {
        $this->db->select( '

			COALESCE( sum(sale_items.quantity*sale_items.unit_price), 0) as amount

			', FALSE );
        $this->db->from( 'sales' );
        $this->db->join( 'sale_items', 'sale_items.sale_id = sales.id', 'left' );
        $this->db->where( 'sales.date', $date );
        $result = $this->db->get();
        return $result->row()->amount;
    }
    public function curentMonthPaid( $date ) {
        $this->db->select( '

			COALESCE( sum(p_payments.amount), 0) as amount

			', FALSE );
        $this->db->from( 'p_payments' );
        $this->db->where( 'p_payments.date', $date );
        $result = $this->db->get();
        return $result->row()->amount;
    }
    public function curentMonthRec( $date ) {
        $this->db->select( '

			COALESCE( sum(s_payments.amount), 0) as amount

			', FALSE );
        $this->db->from( 's_payments' );
        $this->db->where( 's_payments.date', $date );
        $result = $this->db->get();
        return $result->row()->amount;
    }
    public function highCustomers() {
        $this->db->select( '

			customers.name Name,

			COALESCE( sale.amount-COALESCE(sum(s_payments.amount),0)+customers.obalance ,customers.obalance) as Balance,

			', FALSE );
        $this->db->from( 'customers' );
        $sale = "( Select s.customer_id,(sum(si.quantity*si.unit_price-(si.scheme+si.comission)) - (sum(si.quantity*si.unit_price-(si.scheme+si.comission)) / 100 * s.total_tax)) as amount from sales s join sale_items si on s.id = si.sale_id";
        $sale .= " group by s.customer_id ) sale";
        $this->db->join( $sale, 'sale.customer_id = customers.id', 'left' );
        $this->db->join( "s_payments", 's_payments.customer_id = customers.id', 'left' );
        $this->db->group_by( 'customers.id' );
        $this->db->order_by( 'Balance', 'desc' );
        $this->db->limit( 10 );
        $resultSet = $this->db->get();
        return $resultSet;
    }
     public function highSuppliers() {
        $this->db->select( '

            suppliers.name Name,

            COALESCE( purchase.amount-COALESCE(sum(p_payments.amount),0)+suppliers.obalance ,suppliers.obalance) as Balance,

            ', FALSE );
        $this->db->from( 'suppliers' );
        $purchase = "( Select p.supplier_id,sum(pi.quantity*pi.unit_price) as amount from purchases p join purchase_items pi on p.id = pi.purchase_id";
        $purchase .= " group by p.supplier_id ) purchase";
        $this->db->join( $purchase, 'purchase.supplier_id = suppliers.id', 'left' );
        $this->db->join( "p_payments", 'p_payments.supplier_id = suppliers.id', 'left' );
        $this->db->group_by( 'suppliers.id' );
        $this->db->order_by( 'Balance', 'desc' );
        $this->db->limit( 10 );
        $resultSet = $this->db->get();
        return $resultSet;
    }
    public function overallStatus() {
        $data['NetPurchase']    = $this->db->select( 'COALESCE( sum(purchase_items.quantity*purchase_items.unit_price) , 0 ) as NetPurchase', FALSE )->from( 'purchase_items' )->get()->row()->NetPurchase;
        $data['NetPPayment']    = $this->db->select( 'COALESCE( sum(p_payments.amount) , 0 ) as NetPPayment', FALSE )->from( 'p_payments' )->get()->row()->NetPPayment;
        $data['NetSale']        = $this->db->select( 'COALESCE( sum(sale_items.quantity*sale_items.unit_price - (sale_items.scheme+sale_items.comission)) , 0 ) as NetSale', FALSE )->from( 'sale_items' )->get()->row()->NetSale;
        $data['NetSalePayment'] = $this->db->select( 'COALESCE( sum(s_payments.amount), 0 ) as NetSalePayment', FALSE )->from( 's_payments' )->get()->row()->NetSalePayment;
        $data                   = json_decode( json_encode( $data ) );
        return $data;
    }
    public function qLinksData() {
        $data['totalProducts'] = $this->db->count_all('products');
        $data['totalSuppliers'] = $this->db->count_all('suppliers');
        $data['totalPO'] = $this->db->count_all('purchases');
        $data['totalPP'] = $this->db->count_all('p_payments');
        $data['totalCustomers'] = $this->db->count_all('customers');
        $data['totalSale'] = $this->db->count_all('sales');
        $data['totalSalePayment'] = $this->db->count_all('s_payments');
        // $data['totalSale'] = $this->db->count_all('sales');
        // $data['totalSale'] = $this->db->count_all('sales');
        $data = json_decode(json_encode($data));
        return $data;
    }
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */