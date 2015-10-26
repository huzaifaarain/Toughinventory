<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Dbo extends CI_Model
{

	// Common Operations
	function autoID($tableName)
    {
        
        $db        = $this->db->database;
        $resultset = $this->db->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = '$tableName';");
        $row       = $resultset->row();
        $newRow    = $row->AUTO_INCREMENT++;
        return $newRow;
    }

    public function validCred($username,$password)
    {
    	$this->db->select('*')->from('users')->where(array('username'=>$username,'password'=>$password));
    	$result = $this->db->get();
    	if ($result->num_rows() == 1) 
    	{
    		$array = array(
    			'id' => $result->row()->id,
    			'username' => $result->row()->username,
    			'logedin' => true,
    			'fname' => $result->row()->first_name
    		);
    		
    		$this->session->set_userdata( $array );
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function changeP($data,$old_password)
    {
    	$this->db->update('users',$data,array('id'=>$data['id'],'password'=>$old_password));
    	if ($this->db->affected_rows() > 0) 
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function viewUsers($keywords=null)
    {
    	$this->db->select('*');
    	if ($keywords != null) 
    	{
    		if (isset($keywords['id'])) 
    		{
    			$this->db->where('id', $keywords['id']);
    		}
    	}
    	return $this->db->get('users');
    }




    // Product Section Start

	public function viewProducts($keywords = null)
	{
		$this->db->select('*');
		if ($keywords != null) 
		{
			if (isset($keywords['id'])) 
			{
				$this->db->where('id', $keywords['id']);
			}
		}
		return $this->db->get('products');
	}

	public function saveProduct($row)
	{
		$this->db->select('id')->from('products')->where(array('id'=>$row['id']));
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{
			// Update
			$this->db->update('products', $row,array('id'=>$row['id']));
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			// New
			$this->db->insert('products', $row);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	// Product Section End

	// Purchase Section Start

	public function viewSuppliers($keywords = null)
	{
		$this->db->select('*');
		if ($keywords != null) 
		{
				if (isset($keywords['id'])) 
				{
					$this->db->where('id', $keywords['id']);
				}
		}	
		return $this->db->get('suppliers');
	}

	public function saveSupplier($row)
	{
		$this->db->select('id')->from('suppliers')->where(array('id'=>$row['id']));
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{
			// Update
			$this->db->update('suppliers', $row,array('id'=>$row['id']));
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			// New
			$this->db->insert('suppliers', $row);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function savePurchaseOrder($sRow,$purchase_items,$id)
	{
		$this->db->select('id')->from('purchases')->where(array('id'=>$id));
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{
			$this->db->update('purchases', $sRow,array('id'=>$id));
			$this->db->delete('purchase_items',array('purchase_id'=>$id));
			$this->db->insert_batch('purchase_items', $purchase_items);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			# New
			$this->db->insert('purchases', $sRow);
			$this->db->insert_batch('purchase_items', $purchase_items);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function viewPurchases($keywords = null)
	{
		$this->db->select('*');
		if ($keywords != null) 
		{
			if (isset($keywords['id'])) 
			{
				$this->db->where('id', $keywords['id']);
			}
		}
		return $this->db->get('purchases');
	}

	public function viewPurchaseItems($keywords = null)
	{
		$this->db->select('purchase_id,products.name as product_name,product_id,products.size as size,quantity,unit_price');
		$this->db->join('products', 'products.id = purchase_items.product_id', 'left');
		if ($keywords != null) 
		{
			if (isset($keywords['purchase_id'])) 
			{
				$this->db->where('purchase_id', $keywords['purchase_id']);
			}
		}
		return $this->db->get('purchase_items');

	}

	public function savePPayment($row)
	{
		$this->db->select('id')->from('p_payments')->where(array('id'=>$row['id']));
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{
			// Update
			$this->db->update('p_payments', $row,array('id'=>$row['id']));
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			// New
			$this->db->insert('p_payments', $row);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function viewPPayments($keywords = null)
	{
		$this->db->select('*');
		if ($keywords != null) 
		{
			if (isset($keywords['id'])) 
			{
				$this->db->where('id', $keywords['id']);
			}
		}
		return $this->db->get('p_payments');
	}

	public function savePurchaseReturn($sRow,$purchaser_items,$id)
	{
		$this->db->select('id')->from('purchases_r')->where(array('id'=>$id));
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{

			$this->db->update('purchases_r',$sRow,array('id'=>$id));
			$this->db->delete('purchaser_items',array('purchase_id'=>$id));
			$this->db->insert_batch('purchaser_items', $purchaser_items);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			# New
			$this->db->insert('purchases_r', $sRow);
			$this->db->insert_batch('purchaser_items', $purchaser_items);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function viewReturnItem($keywords = null)
	{
		$this->db->select('purchase_id,products.name as product_name,product_id,products.size as size,quantity,unit_price');
		$this->db->join('products', 'products.id = purchaser_items.product_id', 'left');
		if ($keywords != null) 
		{
			if (isset($keywords['purchase_id'])) 
			{
				$this->db->where('purchase_id', $keywords['purchase_id']);
			}
		}
		return $this->db->get('purchaser_items');

	}

	public function viewReturns($keywords = null)
	{
		$this->db->select('*');
		if ($keywords != null) 
		{
			if (isset($keywords['id'])) 
			{
				$this->db->where('id', $keywords['id']);
			}
		}
		return $this->db->get('purchases_r');
	}


	// Purchase Section End

	// Sale Section Start


	# Customer Section

	public function saveCustomer($row)
	{
		$this->db->select('id')->from('customers')->where(array('id'=>$row['id']));
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{
			// Update
			$this->db->update('customers', $row,array('id'=>$row['id']));
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			// New
			$this->db->insert('customers', $row);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function viewCustomers($keywords = null)
	{
		$this->db->select('*');
		if ($keywords != null) 
		{
				if (isset($keywords['id'])) 
				{
					$this->db->where('id', $keywords['id']);
				}
		}	
		return $this->db->get('customers');
	}
	# Customer section End

	# Sale Order Section Start

	public function saveSale($sRow,$sale_items,$id)
	{
		$this->db->select('id')->from('sales')->where(array('id'=>$id));
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{
			$this->db->update('sales', $sRow,array('id'=>$id));
			$this->db->delete('sale_items',array('sale_id'=>$id));
			$this->db->insert_batch('sale_items', $sale_items);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			# New
			$this->db->insert('sales', $sRow);
			$this->db->insert_batch('sale_items', $sale_items);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function viewSales($keywords = null)
	{
		$this->db->select('*');
		if ($keywords != null) 
		{
			if (isset($keywords['id'])) 
			{
				$this->db->where('id', $keywords['id']);
			}
		}
		return $this->db->get('sales');
	}

	public function viewSaleItems($keywords = null)
	{
		$this->db->select('sale_id,products.name as product_name,product_id,products.size as size,quantity,unit_price,scheme,comission,quantity*unit_price-(scheme+comission) as total');
		$this->db->join('products', 'products.id = sale_items.product_id', 'left');
		if ($keywords != null) 
		{
			if (isset($keywords['sale_id'])) 
			{
				$this->db->where('sale_id', $keywords['sale_id']);
			}
		}
		return $this->db->get('sale_items');

	}

	public function saveSalePayment($row)
	{
		$this->db->select('id')->from('s_payments')->where(array('id'=>$row['id']));
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{
			// Update
			$this->db->update('s_payments', $row,array('id'=>$row['id']));
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			// New
			$this->db->insert('s_payments', $row);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function viewSalePayments($keywords = null)
	{
		$this->db->select('*');
		if ($keywords != null) 
		{
			if (isset($keywords['id'])) 
			{
				$this->db->where('id', $keywords['id']);
			}
		}
		return $this->db->get('s_payments');
	}

	public function saveSaleReturn($sRow,$items,$id)
	{
		$this->db->select('id')->from('sales_r')->where(array('id'=>$id));
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{

			$this->db->update('sales_r',$sRow,array('id'=>$id));
			$this->db->delete('saler_items',array('sale_id'=>$id));
			$this->db->insert_batch('saler_items', $items);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			# New
			$this->db->insert('sales_r', $sRow);
			$this->db->insert_batch('saler_items', $items);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function viewSaleReturns($keywords = null)
	{
		$this->db->select('*');
		if ($keywords != null) 
		{
			if (isset($keywords['id'])) 
			{
				$this->db->where('id', $keywords['id']);
			}
		}
		return $this->db->get('sales_r');
	}

	public function viewSaleReturnItems($keywords = null)
	{
		$this->db->select('sale_id,products.name as product_name,product_id,products.size as size,quantity');
		$this->db->join('products', 'products.id = saler_items.product_id', 'left');
		if ($keywords != null) 
		{
			if (isset($keywords['sale_id'])) 
			{
				$this->db->where('sale_id', $keywords['sale_id']);
			}
		}
		return $this->db->get('saler_items');

	}



	// Sale Section End


	// Settings

	public function saveCompanyDetails($row)
	{
		$this->db->select('*')->from('company_details');
		$check = $this->db->get();
		if ($check->num_rows() > 0) 
		{
			$this->db->update('company_details', $row);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			$this->db->insert('company_details', $row);
			if ($this->db->affected_rows() > 0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public function viewCDetails()
	{
		$this->db->select('*')->from('company_details');
		return $this->db->get();
	}

	public function rp_getSetting($column)
	{
		$this->db->select($column);
		$result = $this->db->get('rp_setting');
		$data = $result->row();
		return $data;
	}

	public function stockvalue()
	{
		$this->db->select('
			COALESCE(sum(purchase_items.quantity*purchase_items.unit_price),0) as bycost,
			COALESCE(sum(purchase_items.quantity * products.price),0) as byprice 
			',FALSE);
		$this->db->from('products');
		$this->db->join('purchase_items', 'purchase_items.product_id = products.id');
		$resultSet = $this->db->get();
		return $resultSet;
	}
}

/* End of file dbo.php */
/* Location: ./application/models/dbo.php */