<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**

* 

*/

class Products extends CI_Controller

{

	public function __construct()

	{

		parent::__construct();

		$this->dlib->checkLogin();

	}

	

	public function index()

	{

		// $data['products'] = $row

		$this->load->view('header',array('title'=>"View Products"));

		$this->load->view('products/view_Products');

		$this->load->view('footer');

	}



	public function addProduct()

	{

		if ($_POST) 

		{

			$row = (array)$_POST;

			$row['id'] = $this->dbo->autoID('products');

			$check = $this->dbo->saveProduct($row);

			if ($check) 

			{

				$this->session->set_flashdata('msg', "Saved");

				redirect(current_url(),'refresh');				

			}

			else

			{

				$this->session->set_flashdata('msg', "Error Occured");

				redirect(current_url(),'refresh');				

			}

		}

		else

		{

			$this->load->view('header',array('title'=>"Add Product"));

			$this->load->view('products/add_product');

			$this->load->view('footer');	

		}

		

	}



	public function ajaxgetproducts()

	{

		$this->datatables->select('id,name,unit,size,cost,price,alert_quantity,ostockq,ostockamount')->from('products');

		$this->datatables->add_column('Actions','<div class="btn-group">

			<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">

			Action(s) <span class="caret"></span>

			</button>

			<ul class="dropdown-menu">

			<li><a href="'.site_url('products/editProduct/$1').'">Edit</a></li>

			<li><a onclick="btnDelete();" href="'.site_url('products/deleteProduct/$1').'">Delete</a></li>
			<li><a onclick=\'windowOpen("'.site_url('products/stockLedger?product_id=$1&start_date=&end_date').'");\' href="#">View Ledger</a></li>
			

			</ul></div>','id');

		echo $this->datatables->generate();

	}



	public function productsAutoComplete()

	{

		$resultSet = $this->dbo->viewProducts(null);

		$result = $resultSet->result();

		echo json_encode($result);

	}



	public function editProduct($id)

	{

		if ($_POST) 

		{

			$check = $this->dbo->saveProduct($_POST);

			if ($check) 

			{

				$this->session->set_flashdata('msg', "Updated");

				redirect(site_url('products'),'refresh');

			}

			else

			{

				$this->session->set_flashdata('msg', "Error Occured");

				redirect(site_url('products'),'refresh');

			}

		}

		else

		{

			$product = $this->dbo->viewProducts(array('id'=>$id));

			if ($product->num_rows() == 1) 

			{

				$this->load->view('header',array('title'=>"Edit Product"));

				$this->load->view('products/edit_product',array('product'=>$product));

				$this->load->view('footer');

			}

		}	

	}



	public function deleteProduct($id)

	{

		$this->db->delete('products',array('id'=>$id));

		if ($this->db->affected_rows() > 0) 

		{

			$this->session->set_flashdata('msg', "Deleted");

				redirect(site_url('products'),'refresh');

		}

		else

		{

			$this->session->set_flashdata('msg', "Error Occured");

				redirect(site_url('products'),'refresh');

		}

	}



	public function stockledger()

	{

	

		if ($_GET) 

		{



		 			if($this->input->get('product_id')){ $product = $this->input->get('product_id'); } else { $product = NULL; }

		            if($this->input->get('start_date')){ $start_date = $this->input->get('start_date'); } else { $start_date = NULL; }

		            if($this->input->get('end_date')){ $end_date = $this->input->get('end_date'); } else { $end_date = NULL; }

		            if($start_date) {

		                $pp =    "( SELECT pi.product_id, SUM( pi.quantity ) purchasedQty from purchases p JOIN purchase_items pi on p.id = pi.purchase_id where

		                         p.date >= '{$start_date}' and p.date <= '{$end_date}'

		                         group by pi.product_id ) PCosts";

		                

		                $sp = "( SELECT si.product_id, SUM( si.quantity ) soldQty from sales s JOIN sale_items si on s.id = si.sale_id where

		                       s.date >= '{$start_date}' and s.date <= '{$end_date}'

		                       group by si.product_id ) PSales";

		            } else {

		                $pp ="( SELECT pi.product_id, SUM( pi.quantity ) purchasedQty from purchase_items pi group by pi.product_id ) PCosts";

		                $sp = "( SELECT si.product_id, SUM( si.quantity ) soldQty from sale_items si group by si.product_id ) PSales";

		            }

			  

		        $this->db

		                ->select("p.name as Name,

		                		p.ostockq as ostock,

		                        COALESCE( PCosts.purchasedQty, 0 ) as PurchasedQty,

		                        COALESCE( PSales.soldQty, 0 ) as SoldQty,

		                        COALESCE( COALESCE( PCosts.purchasedQty, 0 ) - COALESCE( PSales.soldQty, 0 ) ,PCosts.purchasedQty) as Avail ", FALSE)

		                ->from('products p', FALSE)

		                ->join($sp, 'p.id = PSales.product_id', 'left')

		                ->join($pp, 'p.id = PCosts.product_id', 'left');

		                       // ->group_by('p.id');



				if($product) { $this->db->where('p.id', $product); }	



	   			$resultSet = $this->db->get();

				$this->load->view('reports/rp_header',array('title'=>"Stock Ledger"));

				$this->load->view('reports/rp_stockledger',array('resultSet'=>$resultSet));

				$this->load->view('reports/rp_footer');

		}

		else

		{

				$this->load->view('header',array('title'=>"Stock Ledger"));

				$this->load->view('products/stockledger');

				$this->load->view('footer');

		}

	}

}



/* End of file products.php */

/* Location: ./application/controllers/products.php */