 <!-- PDF Export -->
	
    <?php include('header.php');?>
<div  id="print_div" >
<?php 
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$name = singleDbTableRow($user_id)->first_name.' '.singleDbTableRow($user_id)->last_name;
foreach ($terms->result() as $t)
{?>
<br>
<a href="<?php echo base_url('Term_condition/term_condition_pdf_export/'.$t->id) ?>" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> Download PDF</a>&nbsp;&nbsp;
<a href="<?php echo base_url('Term_condition/term_condition_print/'.$t->id) ?>" class="btn btn-primary"  target="_blank" ><i class="fa fa-print"></i> Print</a>&nbsp;&nbsp;

<a href="<?php echo base_url('Term_condition/term_condition_view/'.$t->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
<section class="content">
    <div class="row">
        
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F">File : <?php echo $t->file_name;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php $labels = $this->db->order_by('id','desc')->get_where('term_condition_labels', ['term_ID' => $t->term_ID]);
					if($labels ->num_rows() >0)
					{
						$replace  = '';
						$find     = '';
						$string = $t->file_data;
						foreach ($labels->result() as $l) 
						{ 
							 
							$field = $l->t_field;
							$field_value =  singleDbTableRow($user_id)->$field;
							$string   = str_replace($l->t_label,$field_value,$string);
						 	
						}
							
					 } 
					 else
					 { 
					 
						$string = $t->file_data;
					 }
					echo $string; 
					?>
                   
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!--/.Custom labels -->

</div>
</section>
<?php } ?>
</div>

<a href="<?php echo base_url('Term_condition/term_condition_pdf_export/'.$t->id) ?>" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> Download PDF</a>&nbsp;&nbsp;
<a href="<?php echo base_url('Term_condition/term_condition_print/'.$t->id) ?>" class="btn btn-primary"  target="_blank" ><i class="fa fa-print"></i> Print</a>&nbsp;&nbsp;

<a href="<?php echo base_url('Term_condition/term_condition_view/'.$t->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
<br></br>
<div class="box-footer"></div>
<script>
	$(document).ready(function(){
	var form = $('#print_div'),
	//	cache_width = form.width(),
		a4  =[ 830,  841.89];  // for a4 size paper width and height

	$('#create_pdf').on('click',function(){
		//$('body').scrollTop(0);
		createPDF();
	});
	//create pdf
	function createPDF(){
		getCanvas().then(function(canvas){
			var 
			img = canvas.toDataURL("image/png"),
			doc = new jsPDF({
			  unit:'px', 
			  format:'a3'
			});     
			doc.addImage(img, 'JPEG', 20, 20);
			doc.save('events_report.pdf');
			//form.width(cache_width);
		});
	}

	// create canvas object
	function getCanvas(){
		form.width((a4[0]*1.33333) -80).css('max-width','none');
		return html2canvas(form,{
			imageTimeout:2000,
			removeContainer:true
		});	
	}

	});
</script>