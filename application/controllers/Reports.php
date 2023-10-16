<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Admin_acess');
		$this->load->library('CSV_file');
		$this->load->library('Pdf');
		$this->load->model('Reports_model', 'reports');
		$this->load->model('Properties_model', 'properties');
		$this->load->model('Tenants_model', 'tenants');
	}

	function getPendingInstallments()
	{

		$filter = isset($_GET['filter']) ? strval($_GET['filter']) : null;
		$rprts = $this->reports->getPendingInstallments($filter);

		$dacc = json_decode(json_encode($rprts), true);

		$file_name  = FCPATH . "/attachments/data/csv/getpendinginstallments.csv";
		$file = fopen($file_name, 'w');
		fwrite($file, "\xEF\xBB\xBF");

		// Write header row to the CSV file
		$header = array(
			$this->lang->line('CONTRACT_NUMBER'),
			$this->lang->line('BUILDING_STATEMENT'),
			$this->lang->line('TENANT_NAME'),
			$this->lang->line('INSTALLMENT_DATE'),
			$this->lang->line('INSTALLMENT_AMOUNT'),
			$this->lang->line('PAID_AMOUNT'),
			$this->lang->line('PENDING_AMOUNT'),
			$this->lang->line('INSTALLMENT_NO'),
			$this->lang->line('PAID_DATE')
		);
		fputcsv($file, $header);

		foreach ($dacc as $row) {
			// Extract specific columns from $row array
			$datassd = array(
				$row["contractNumber"],
				$row["propertyName"],
				$row["tenantName"],
				$row["installmentDate"],
				$row["installmentDate"],
				$row["paidAmount"],
				$row["pendingAmount"],
				$row["installmentNumber"],
				$row["paidDate"]
			);

			// Write extracted values to the CSV file
			fputcsv($file, $datassd);
		}

		fclose($file);


		// Assuming TCPDF is loaded as 'Pdf' in your CodeIgniter 3 application
		$obj_pdf = new Pdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$obj_pdf->SetTitle($this->lang->line('Pending_installment_data'));
		$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('aealarabiya');
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
		$obj_pdf->setPrintHeader(false);
		$obj_pdf->setPrintFooter(false);
		$obj_pdf->SetAutoPageBreak(TRUE, 5);
		$obj_pdf->SetFont('aealarabiya', '', 9);
		$obj_pdf->AddPage("L");
		$content = '';
		$content .= '  
		<h3 align="center">'.$this->lang->line('Pending_installment_data').'</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>   
                <th>' . $this->lang->line('CONTRACT_NUMBER') . '</th>  
                <th>' . $this->lang->line('BUILDING_STATEMENT') . '</th>  
                <th>' . $this->lang->line('TENANT_NAME') . '</th>  
                <th>' . $this->lang->line('INSTALLMENT_AMOUNT') . '</th>  
                <th>' . $this->lang->line('INSTALLMENT_DATE') . '</th>  
                <th>' . $this->lang->line('PAID_AMOUNT') . '</th>  
                <th>' . $this->lang->line('PENDING_AMOUNT') . '</th>  
                <th>' . $this->lang->line('INSTALLMENT_NO') . '</th>  
                <th>' . $this->lang->line('PAID_DATE') . '</th>  
           </tr>';

		$output = "";
		$bjbb = json_decode(json_encode($rprts), true);
		foreach ($bjbb as $key => $row) {
			$output .= '<tr>  
                          <td>' . $row["contractNumber"] . '</td>  
                          <td>' . $row["propertyName"] . '</td>  
                          <td>' . $row["tenantName"] . '</td>  
                          <td>' . $row["installmentDate"] . '</td>  
                          <td>' . $row["installmentDate"] . '</td>  
                          <td>' . $row["paidAmount"] . '</td>  
                          <td>' . $row["pendingAmount"] . '</td>  
                          <td>' . $row["installmentNumber"] . '</td>  
                          <td>' . $row["paidDate"] . '</td>  
                     </tr>  
                          ';
		}
		$content .= $output;
		$content .= '</table>';
		$obj_pdf->writeHTML($content);
		// Output PDF
		$pdffile = FCPATH . "/attachments/data/pdf/getpendinginstallments.pdf";
		$obj_pdf->Output($pdffile, 'F');



		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'pendinginstallments';
		$data['pendingInstallments'] = $rprts;
		$data['searched_data'] = $rprts;
		$this->load->view('admin/header', $data);
		$this->load->view('reports/pendingInstallments', $data);
		$this->load->view('admin/footer', $data);
	}
	function getExpiringContracts()
	{
		$filter = isset($_GET['filter']) ? strval($_GET['filter']) : null;
		$rprts = $this->reports->contracts_list_expiring_in($days = 30, $filter);
		// $exporttyp = $this->uri->segment(3);
		$dacc = json_decode(json_encode($rprts), true);
		$file_name  = FCPATH . "/attachments/data/csv/expiringcontracts.csv";
		$file = fopen($file_name, 'w');
		fwrite($file, "\xEF\xBB\xBF");

		// Write header row to the CSV file
		$header = array(
			$this->lang->line('CONTRACT_NUMBER'),
			$this->lang->line('EXPIRY_DATE'),
			$this->lang->line('DAYS_LEFT'),
			$this->lang->line('BUILDING_STATEMENT'),
			$this->lang->line('TENANT_NAME'),
			$this->lang->line('INSTALLMENT_DATE'),
			$this->lang->line('INSTALLMENT_AMOUNT'),
			$this->lang->line('PAID_AMOUNT'),
			$this->lang->line('PENDING_AMOUNT'),
			$this->lang->line('PAID_DATE')
		);
		fputcsv($file, $header);

		foreach ($dacc as $row) {
			// Extract specific columns from $row array
			$datass = array(
				$row["contractNumber"],
				$row["expiryDate"],
				$row["days_left"],
				$row["propertyName"],
				$row["tenantName"],
				$row["installmentDate"],
				$row["installmentAmount"],
				$row["paidAmount"],
				$row["pendingAmount"],
				$row["paidDate"]
			);

			// Write extracted values to the CSV file
			fputcsv($file, $datass);
		}

		fclose($file);



		// Assuming TCPDF is loaded as 'Pdf' in your CodeIgniter 3 application
		$obj_pdf = new Pdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$obj_pdf->SetTitle($this->lang->line('Expiring_Contracts_Data'));
		$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('aealarabiya');
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
		$obj_pdf->setPrintHeader(false);
		$obj_pdf->setPrintFooter(false);
		$obj_pdf->SetAutoPageBreak(TRUE, 5);
		$obj_pdf->SetFont('aealarabiya', '', 9);
		$obj_pdf->AddPage("L");
		$content = '';
		$content .= '  
<h3 align="center">'.$this->lang->line('Expiring_Contracts_Data').'</h3><br /><br />  
<table border="1" cellspacing="0" cellpadding="5">  
   <tr>   
		<th>' . $this->lang->line('CONTRACT_NUMBER') . '</th>  
		<th>' . $this->lang->line('EXPIRY_DATE') . '</th> 
		<th>' . $this->lang->line('DAYS_LEFT') . '</th>   
		<th>' . $this->lang->line('BUILDING_STATEMENT') . '</th>   
		<th>' . $this->lang->line('TENANT_NAME') . '</th>  
		<th>' . $this->lang->line('INSTALLMENT_AMOUNT') . '</th>  
		<th>' . $this->lang->line('INSTALLMENT_DATE') . '</th>  
		<th>' . $this->lang->line('PAID_AMOUNT') . '</th>  
		<th>' . $this->lang->line('PENDING_AMOUNT') . '</th>  
		<th>' . $this->lang->line('INSTALLMENT_NO') . '</th>  
		<th>' . $this->lang->line('PAID_DATE') . '</th>  
   </tr>';
		$output = "";
		$bjbb = json_decode(json_encode($rprts), true);
		foreach ($bjbb as $key => $row) {
			$output .= '<tr>  
				  <td>' . $row["contractNumber"] . '</td>  
				  <td>' . $row["expiryDate"] . '</td>  
				  <td>' . $row["days_left"] . '</td>  
				  <td>' . $row["propertyName"] . '</td>  
				  <td>' . $row["tenantName"] . '</td>  
				  <td>' . $row["installmentDate"] . '</td>  
				  <td>' . $row["installmentDate"] . '</td>  
				  <td>' . $row["paidAmount"] . '</td>  
				  <td>' . $row["pendingAmount"] . '</td>  
				  <td>' . $row["installmentNumber"] . '</td>  
				  <td>' . $row["paidDate"] . '</td>  
			 </tr>  
				  ';
		}
		$content .= $output;
		$content .= '</table>';
		$obj_pdf->writeHTML($content);
		// Output PDF
		$pdffile = FCPATH . "/attachments/data/pdf/expiringcontracts.pdf";
		$obj_pdf->Output($pdffile, 'F');


		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'expiringcontracts';
		$data['expiringcontracts'] = $rprts;
		$data['searched_data'] = $rprts;
		$this->load->view('admin/header', $data);
		$this->load->view('reports/expiringcontracts', $data);
		$this->load->view('admin/footer', $data);
	}
}
