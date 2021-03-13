<?php
namespace Drupal\curriculum\Controller;

use Drupal\Core\Controller\ControllerBase;
// use Drupal\taxonomy\Entity\Term;

class Invoice extends ControllerBase {

  public function show($nid) {

	\Drupal::service('page_cache_kill_switch')->trigger();

	$output = '<!DOCTYPE html>';
	$output .= '<html>';
	$output .= '<head>';
	$output .= '<style>';
	$output .= 'body {font-family: Verdana; font-size:13px;}';
	$output .= 'a {color:#337ab7; text-decoration:none;}';

	$output .= '.col-12{float:left; width:100%;}';
	$output .= '.col-10{float:left; width:82%;}';
	$output .= '.col-9{float:left; width:79%;}';
	$output .= '.col-8{float:left; width:65%;}';
	$output .= '.col-6{float:left; width:49%;}';
	$output .= '.col-4{float:left; width:32%;}';
	$output .= '.col-3{float:left; width:24%;}';
	$output .= '.col-2{float:left; width:16%;}';

	$output .= '</style>';
	$output .= '</head>';
	
	$output .= '<body>';
	
	$node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
	$me = [
		'<strong>Piero Nanni</strong>',
		'Flat 75, Panorama Apartments',
		'2 Harefield Road',
		'UB8 1GW',
		'Uxbridge',
		'United Kingdom',
		'',
		'+44 7724146851',
		'piero.nanni@gmail.com'
	];

	######################################################### Price, due by and ME!
	$output .= '<div class="col-8" style="font-size:30px;">';
		$output .= 'Invoice for: <strong>£'.$node->get('field_price')->value.'</strong>';
		$output .= ' due by <strong>'.date('d/m/Y', strtotime($node->get('field_due_by')->value)).'</strong>';
	$output .= '</div>';

	$output .= '<div class="col-4">';
		$output .= implode('<br>', $me);
	$output .= '</div>';

	######################################################### Client, Invoice date and number
	$output .= '<br><br><div class="col-8">';
		$output .= '<div><strong>To</strong></div>';
		$output .= $node->get('field_client')->value;
	$output .= '</div>';

	$output .= '<div class="col-4">';
		$output .= '<div>Invoice date</div>';
		$output .= '<strong>'.date('d/m/Y', $node->get('created')->value).'</strong>';
	$output .= '</div>';

	######################################################### Description
	$output .= '<br><br><div class="col-8">';
		$output .= '<div><strong>Description</strong></div>';
		$output .= $node->get('field_description')->value;
	$output .= '</div>';

	$output .= '<div class="col-2">';
		$output .= '<div style="margin-bottom:10px"><strong>QTY</strong></div>';
		$output .= '1';
	$output .= '</div>';

	$output .= '<div class="col-2">';
		$output .= '<div style="margin-bottom:10px"><strong>Amount</strong></div>';
		$output .= '£'.$node->get('field_price')->value;
	$output .= '</div>';

	######################################################### Payment details
	$output .= '<br><br><div class="col-10">';
		$output .= 'Please make payment to<br>';
		$output .= 'Piero Nanni<br>';
		$output .= 'Account number: 60299405<br>';
		$output .= 'Sort code: 20-44-91<br>';
	$output .= '</div>';

	$output .= '<div class="col-2">';
		$output .= '<div><strong>Total</strong></div>';
		$output .= '£'.$node->get('field_price')->value;
	$output .= '</div>';

	$output .= '</body>';
	$output .= '</html>';


	########## Creo il pdf
	// echo $output;
	$mpdf = new \Mpdf\Mpdf([
		'tempDir' => 'sites/default/files/tmp',
		'margin_left' => 10,
		'margin_right' => 10,
		'margin_top' => 10,
		'margin_bottom' => 10,
		'default_font' => 'helvetica'
	]);
	$mpdf->SetTitle('Invoice - SoundPickr');
	$mpdf->SetAuthor("Piero Nanni");
	
	$mpdf->WriteHTML($output); // write page content inside pdf
	
	$mpdf->Output('invoice_alex_lopez_'.date('Y').'_'.date('m').'_'.date('d').'.pdf', \Mpdf\Output\Destination::INLINE);

	// exit;

	return [
		'#markup' => time(),
		'#cache' => ['max-age' => 0,]
	];
  }
}