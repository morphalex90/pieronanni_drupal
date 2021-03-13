<?php
namespace Drupal\curriculum\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\taxonomy\Entity\Term;

class PDF extends ControllerBase {

  public function curriculum() {

	\Drupal::service('page_cache_kill_switch')->trigger();

	$isAnonymous = \Drupal::currentUser()->isAnonymous();

	if( $isAnonymous ) {
		$new_term = Term::create([
			'vid' => 'clicks',
			'name' => 'CV',
		]);

		$new_term->enforceIsNew();
		$new_term->save();
	}

	$output = '<!DOCTYPE html>';
	$output .= '<html>';
	$output .= '<head>';
	$output .= '<style>';
	$output .= 'body {font-family: Calibri, sans-serif; font-size:14px;}';
	$output .= 'a {color:#337ab7; text-decoration:none;}';

	$output .= '.col-8{float:left; width:66%;}';
	// $output .= '.col-7{float:left; width:58%;}';
	$output .= '.col-6{float:left; width:49%;}';
	// $output .= '.col-5{float:left; width:41%;}';
	$output .= '.col-4{float:left; width:33%;}';
	$output .= '.col-3{float:left; width:24%;}';
	$output .= '.clear{clear:both;}';

	$output .= '.text-center{text-align:center;}';
	$output .= '.text-right{text-align:right;}';

	$output .= 'ul{margin-top:0px; padding-left:15px;}';
	$output .= '.project-list{list-style-type:none; padding-left:0;}';

	$output .= '.section strong{margin-bottom:5px; font-size:20px;}';
	$output .= '</style>';
	$output .= '</head>';
	
	
	$output .= '<body>';
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Heading
	$output .= '<div class="col-4">';
	$output .= '<div style="margin-left:20px; margin-right:20px; padding-top:20px;">';
		$output .= '<div style="font-size:25px; font-weight:bold;">Piero Nanni</div>';
		$output .= '<div style="margin-bottom:10px;">Web developer</div>';
		$output .= '<div><em>"I don\'t know, it\'s something about web developing that calms me down, ya know?"</em></div>';

	$output .= '</div>';
	$output .= '</div>';

	$output .= '<div class="col-4 text-center">';
		$output .= '<img height="150" width="150" style="border-left:2px solid #000; border-right:2px solid #000;" src="data:image/jpeg;base64,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">';
	$output .= '</div>';

	$output .= '<div class="col-4 text-right">';
	$output .= '<div style="margin-left:20px; margin-right:20px; padding-top:20px;">';
		$output .= '<div>London, UK</div>';
		$output .= '<div>+44 7724 146851</div>';
		$output .= '<div><a href="https://www.pieronanni.com">www.pieronanni.com</a></div>';
		$output .= '<div><a href="mailto:piero.nanni@gmail.com">piero.nanni@gmail.com</a></div>';
		$output .= '<div><a href="https://github.com/morphalex90">github.com/morphalex90</a></div>';
	$output .= '</div>';
	$output .= '</div>';

	$output .= '<div style="height:2px; width:100%; background-color:black; margin-bottom:20px;"></div>';

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Work Experience
	$output .= '<div class="col-8">';
	$output .= '<div style="margin-left:20px; border-right:2px solid #000; padding-right:20px;">';

		$output .= '<div class="section"><strong>WORK EXPERIENCE</strong></div>';
		$query = \Drupal::entityQuery('taxonomy_term');
		$query->condition('vid', "job");
		$query->sort('field_start_date', 'DESC');
		$tids = $query->execute();

		$jobs = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadMultiple($tids);
		if( count($jobs) > 0 ) {
			foreach( $jobs as $job ) {
				$start_date = $job->get('field_start_date')->value;
				$end_date = $job->get('field_end_date')->value;
				
				$output .= '<div style="margin-top:10px;"><strong>'.$job->getName().'</strong></div>';
				$output .= '<a href="'.$job->get('field_company')->uri.'">'.$job->get('field_company')->title.'</a><br>';
				$output .= '<div class="col-6"><i>'.date('m/Y', strtotime($start_date));

				if( $end_date ) {
					$output .= ' - '.date('m/Y', strtotime($end_date));
				} else {
					$output .= ' - Present';
				}
				$output .= '</i></div>';

				$output .= '<div class="col-6 text-right"><i>'.$job->get('field_location')->value.'</i></div>';
				// $output .= '<div style="margin-top:5px; font-style: italic;">Accomplishments:</div>';
				$output .= '<div>'.$job->get('field_description_cv')->value.'</div>';

				////////////////////////////////////////////// Load Projects relative to the Job
				$query = \Drupal::entityQuery('node');
				$query->condition('type', "project");
				$query->condition('field_job',  $job->id());
				$query->sort('field_publish_date', 'DESC');
				$nids = $query->execute();

				$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);
				$nodesCount = count($nodes);
				$count = 1;

				if( $nodesCount > 0 ) {
					$output .= '<div class="col-6"><ul class="project-list">';
					foreach( $nodes as $node ) {
						$technology = Term::load($node->get('field_technology')->target_id);
						$technologyLogo = file_create_url($technology->get('field_image')->entity->getFileUri());

						$output .= '<li><img src="'.$technologyLogo.'" height="15" width="15"> <a href="'.$node->get('field_url')->value.'">'.$node->getTitle().'</a></li>';
						if( $count == (int)($nodesCount/2) ) {
							$output .= '</ul></div><div class="col-6"><ul class="project-list">';
						}
						$count++;
					}
					$output .= '</ul></div>';
					$output .= '<div class="clear"></div>';
				}
			}
		}

		// $output .= '<div class="section"><strong>Projects</strong></div>';

	$output .= '</div>';
	$output .= '</div>';

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Sidebar
	$output .= '<div class="col-4">';
	$output .= '<div style="margin-left:20px; margin-right:20px;">';

		$output .= '<div class="section"><strong>TECHNICAL SKILLS</strong></div>';
			$output .= '<ul>';

			$output .= '<li>Languages<ul>';
			$output .= '<li>HTML5</li>';
			$output .= '<li>PHP</li>';
			$output .= '<li>JavaScript</li>';
			$output .= '<li>CSS3, Sass & BEM</li>';
			$output .= '<li>SQL</li>';
			$output .= '</ul></li>';

			$output .= '<li>CMS<ul>';
			$output .= '<li>WordPress</li>';
			$output .= '<li>Drupal 6, 7, 8</li>';
			$output .= '<li>Magento 1</li>';
			$output .= '</ul></li>';
			
			$output .= '<li>Frameworks<ul>';
			$output .= '<li>Laravel</li>';
			$output .= '</ul></li>';

			$output .= '<li>Libraries<ul>';
			$output .= '<li>Bootstrap</li>';
			$output .= '<li>React</li>';
			$output .= '<li>jQuery</li>';
			$output .= '</ul></li>';
			
			$output .= '<li>Gulp</li>';
			$output .= '<li>Git</li>';
			$output .= '<li>Linux shell</li>';

			
			// $output .= '<li>Linux terminal (Linux Command line)</li>';
			$output .= '</ul>';

		$output .= '<div class="section"><strong>PERSONAL SKILLS</strong></div>';
			$output .= '<ul>';
			$output .= '<li>Flexible</li>';
			$output .= '<li>Multi tasking</li>';
			$output .= '<li>Adaptive to change</li>';
			$output .= '<li>Enthusiastic about web development</li>';
			$output .= '<li>Learn new skills every day</li>';
			$output .= '</ul>';

		$output .= '<div class="section"><strong>EDUCATION</strong></div>';
			$output .= '<ul>';
			$output .= '<li>2018 - Web Analytics @ Mb web, Milan, Italy</li>';
			$output .= '<li>2014 - HTML/CSS course @ CdS Bologna, Bologna, Italy</li>';
			$output .= '<li>2010 - Computer Science course @ Aldini Valeriani Sirani, Bologna, Italy</li>';
			$output .= '</ul>';

		

		$output .= '<div class="section"><strong>INTERESTS</strong></div>';
			$output .= '<ul>';
			$output .= '<li>Synthwave enthusiast</li>';
			$output .= '<li>Cyberpunk</li>';
			$output .= '<li>Building desktop PC</li>';
			// $output .= '<li>Movies</li>';
			$output .= '</ul>';

		$output .= '<div class="section"><strong>LANGUAGES</strong></div>';
			$output .= '<ul>';
			$output .= '<li>Italian - mother tongue</li>';
			$output .= '<li>English - medium level</li>';
			$output .= '</ul>';

	$output .= '</div>';
	$output .= '</div>';

	############ Blocco me
	// $block = \Drupal\block\Entity\Block::load('me');
	// $result = \Drupal::entityManager()->getViewBuilder('block')->view($block);
	// $output .= \Drupal::service('renderer')->renderRoot($result);
	
	############# Vista dei lavori
	// $vMn = 'lavori'; // View machine name
	// $dMn = 'block_1'; // Display machine name
	// $view = \Drupal\views\Views::getView($vMn);
	// $view->setDisplay($dMn);
	// $view->execute();
	// $render = $view->render();
	// $result = \Drupal::service('renderer')->renderRoot($render);
	// $output .= $result;


	############ Blocco descrizione
	// $block = \Drupal\block\Entity\Block::load('chisonobloccointegrativo');
	// $result = \Drupal::entityManager()->getViewBuilder('block')->view($block);
	// $output .= \Drupal::service('renderer')->renderRoot($result);
	
	$output .= '</body>';
	$output .= '</html>';


	########## Creo il pdf
	// echo $output;
	$mpdf = new \Mpdf\Mpdf([
		'tempDir' => 'sites/default/files/tmp',
		'margin_left' => 0,
		'margin_right' => 0,
		'margin_top' => 0,
		'margin_bottom' => 0,
		'default_font' => 'calibri'
	]);
	$mpdf->SetTitle('Curriculum Vitae Piero Nanni');
	$mpdf->SetAuthor("Piero Nanni");
	
	$mpdf->WriteHTML($output);
	
	$mpdf->Output('cv_piero_nanni.pdf', \Mpdf\Output\Destination::INLINE);

	// exit;

	return [
		'#markup' => time(),
		'#cache' => ['max-age' => 0]
	];
  }
}