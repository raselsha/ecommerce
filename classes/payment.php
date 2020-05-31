<?php 

/**
 * 
 */
class payment extends connection
{
	
	public function gen_invoice($data)
	{	

		ini_set('display_errors',1); 
		error_reporting(E_ALL);
		$mode = "sandbox";
		$config_data=[
		            'sandbox'=>[
		                'invoice_endpoint'  => 'https://api-sandbox.portwallet.com/payment/v2/invoice/',
		                'ipn_endpoint'      => 'https://api-sandbox.portwallet.com/payment/v2/invoice/ipn/',
		                'app_key'           => 'da7c9bf81565d67ae75667e51d3dff68',
		                'secret_key'        => '27fa3246fb9dff3b83726b5148351d99'
		            ],
		            'live'=>[
		                'invoice_endpoint'  => 'https://api.portwallet.com/payment/v2/invoice/',
		                'ipn_endpoint'      => 'https://api.portwallet.com/payment/v2/invoice/ipn/',
		                'app_key'           => 'da7c9bf81565d67ae75667e51d3dff68',
		                'secret_key'        => '27fa3246fb9dff3b83726b5148351d99'
		            ]
		        ];


		$data = [
		    'order' => [
		        'amount' => $data['amount'],
		        'currency' => 'BDT',
		        'redirect_url' => "http://www.myshahadat.com/demo/ecommerce/success.php",
		        'ipn_url' => "http://http://www.myshahadat.com/demo/ecommerce/success.php",
		        'reference' => '123',
		    ],
		    'product' => [
		        'name' => 'Hamdard product',
		        'description' => 'Hamdard description',
		        
		    ],
		    'billing' => [
		        'customer' => [
		            'name' => $data['name'],
		            'email' => $data['email'],
		            'phone' => $data['phone'],
		            'address' => [
		                'street' => $data['address'],
		                'city' => $data['city'],
		                'state' => 'unknown',
		                'zipcode' => 'unknown',
		                'country' => 'BD'
		            ]
		        ]
		    ],
		    'shipping' => [
		        'customer' => [
		            'name' => $data['ship_to_name'],
		            'email' => $data['ship_to_email'],
		            'phone' => $data['ship_to_phone'],
		            'address' => [
		                'street' => 'unknown',
		                'city' => 'unknown',
		                'state' => 'unknown',
		                'zipcode' => 'unknown',
		                'country' => 'BD'
		            ]
		        ]
		    ],
		    'customs' => [
		        // ['book_seats' => $data['book_seats']],
		        // ['book_date' => $data['book_date']],
		        // ['book_show_time' => $data['book_show_time']],
		        // ['book_mov_id' => $data['book_mov_id']]
		    ]

		];

		$headers[] = 'Authorization: ' . 'Bearer ' . base64_encode($config_data[$mode]['app_key'] . ":" . md5($config_data[$mode]['secret_key'] . time()));
		$headers[] = 'Content-Type: ' . 'application/json';


		$data = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $config_data[$mode]['invoice_endpoint']);     
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if (substr($info['http_code'],0,2) == 20 && !empty($response)) {
		    $response = json_decode($response);
		}
		$url = $response->data->action->url;
		header("Location: $url"); /* Redirect browser */
	}

	public function get_invoice($invoice)
	{	
		ini_set('display_errors',1); 
		error_reporting(E_ALL);
		$mode = "sandbox";
		$config_data=[
		            'sandbox'=>[
		                'invoice_endpoint'  => 'https://api-sandbox.portwallet.com/payment/v2/invoice/'.$invoice,
		                'ipn_endpoint'      => 'https://api-sandbox.portwallet.com/payment/v2/invoice/ipn/',
		                'app_key'           => '1a66c14e81f97c49989a8bd1ea661ff7',
		                'secret_key'        => '3c70edaaee8770b3f6ca77f28b26b36c'
		            ],
		            'live'=>[
		                'invoice_endpoint'  => 'https://api.portwallet.com/payment/v2/invoice/',
		                'ipn_endpoint'      => 'https://api.portwallet.com/payment/v2/invoice/ipn/',
		                'app_key'           => '1a66c14e81f97c49989a8bd1ea661ff7',
		                'secret_key'        => '3c70edaaee8770b3f6ca77f28b26b36c'
		            ]
		        ];
		
		$headers[] = 'Authorization: ' . 'Bearer ' . base64_encode($config_data[$mode]['app_key'] . ":" . md5($config_data[$mode]['secret_key'] . time()));
		$headers[] = 'Content-Type: ' . 'application/json';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $config_data[$mode]['invoice_endpoint']);
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if (substr($info['http_code'],0,2) == 20 && !empty($response)) {
		    $data = json_decode($response);
		    $data = json_decode(json_encode($data), true);
		    return $data;
		}
	}

	public function get_ipn($data)
	{	
		ini_set('display_errors',1); 
		error_reporting(E_ALL);
		$mode = "sandbox";
		$config_data=[
		            'sandbox'=>[
		                'invoice_endpoint'  => 'https://api-sandbox.portwallet.com/payment/v2/invoice/',
		                'ipn_endpoint'      => 'https://api-sandbox.portwallet.com/payment/v2/invoice/ipn/'.$data['invoice'].'/'.$data['amount'],
		                'app_key'           => '1a66c14e81f97c49989a8bd1ea661ff7',
		                'secret_key'        => '3c70edaaee8770b3f6ca77f28b26b36c'
		            ],
		            'live'=>[
		                'invoice_endpoint'  => 'https://api.portwallet.com/payment/v2/invoice/',
		                'ipn_endpoint'      => 'https://api.portwallet.com/payment/v2/invoice/ipn/',
		                'app_key'           => '1a66c14e81f97c49989a8bd1ea661ff7',
		                'secret_key'        => '3c70edaaee8770b3f6ca77f28b26b36c'
		            ]
		        ];
		
		$headers[] = 'Authorization: ' . 'Bearer ' . base64_encode($config_data[$mode]['app_key'] . ":" . md5($config_data[$mode]['secret_key'] . time()));
		$headers[] = 'Content-Type: ' . 'application/json';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $config_data[$mode]['ipn_endpoint']);
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		$info = curl_getinfo($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if (substr($info['http_code'],0,2) == 20 && !empty($response)) {
		    $data = json_decode($response);
		    $data = json_decode(json_encode($data), true);
		    return $data;
		}
	}

	public function new_payment($data){
		$con = $this->connect();
		$exist_pay=$this->exist_payment($data['pay_invoice']);	
		if ($exist_pay['pay_invoice']!=$data['pay_invoice']) {	
			$sql = "INSERT into payment(pay_cust_id,pay_invoice,pay_price,pay_created_at)
			values('$data[pay_cust_id]','$data[pay_invoice]','$data[pay_price]','$data[pay_created_at]')";
			if (mysqli_query($con,$sql)) {
				return true;
			}
			else{
				echo mysqli_error($con);
			}
		}
	}

	public function exist_payment($invoice){
		$con = $this->connect();
		$sql="SELECT * FROM payment WHERE pay_invoice = '$invoice'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}
}


?>