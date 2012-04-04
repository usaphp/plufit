<?php
/*
Plugin Name: DynPicWaterMark
Plugin URI: http://wordpress.org/extend/plugins/dynpicwatermark
Description: DynPicWaterMark Plugin create dinamyc watermarks keeping original images
Version: 1.1
Author: Rafael Batista Lorenzoni
Author URI: https://sites.google.com/site/rlorenzoni/
License: GPL2
*/
/*  Copyright 2010  Rafael Batista Lorenzoni  (email : r.lorenzoni@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function dynpicwatermark_scape_regex_specials($string_to_scape_chars) {
	return preg_replace("/([\/\\\.\[\]\^\$])/i", "\\\\$1", $string_to_scape_chars);
}

function dynpicwatermark_wp_option_upload_path_get(){
	if (get_option('upload_path') == false) {
		$dynpicwatermark_wp_option_upload_path = 'wp-content/uploads';
	} else {
		$dynpicwatermark_wp_option_upload_path = get_option('upload_path');
	}
	return $dynpicwatermark_wp_option_upload_path;
}

function dynpicwatermark_get_attached_file($file){
	$pattern     = "/(" .dynpicwatermark_scape_regex_specials(dynpicwatermark_wp_option_upload_path_get()). "\/)([^\.]*\.)(jpg|gif|jpeg|png)/i";
	$replacement = 'wp-content/plugins/dynpicwatermark/DynPicWaterMark_ImageViewer.php?path=$2$3';        
	
	$file = preg_replace($pattern, $replacement, $file);
	return $file;
}

add_filter('get_attached_file', 'dynpicwatermark_get_attached_file',0);


function dynpicwatermark_autoredirect_watermark ($content) {
	if (get_option('upload_path') == false) {
		$dynpicwatermark_wp_option_upload_path = 'wp-content/uploads';
	} else {
		$dynpicwatermark_wp_option_upload_path = get_option('upload_path');
	}
	if (get_option('dynpicwatermark_mark_any_image') == 'true') { 
		$pattern     = "/(<img[^>]*src=\"" . dynpicwatermark_scape_regex_specials(get_option('siteurl')) . "\/)(" .dynpicwatermark_scape_regex_specials($dynpicwatermark_wp_option_upload_path). "\/)([^\.]*\.)(jpg|gif|jpeg|png)/i";
		$replacement = '$1wp-content/plugins/dynpicwatermark/DynPicWaterMark_ImageViewer.php?path=$3$4';        
	} else {
		$pattern     = "/(<a[^>]*href=)([^>]*wp-content\/plugins\/dynpicwatermark\/DynPicWaterMark_ImageViewer.php)(\?position=)?([N|T|M|B]+[N|L|C|R]+)?(&amp;|\?|&)+(path=[^\"]*\")([^>]*>[^<]*<img[^>]*src=)(\"[^\"]*\")([^>]*>)/i";
		$replacement = '$1$2$3$4$5$6$7$2?position=$4&$6$9';    
	}
	$content = preg_replace($pattern, $replacement, $content);
	$content = str_replace("plugins/DynPicWaterMark/DynPicWaterMark_ImageViewer", "plugins/dynpicwatermark/DynPicWaterMark_ImageViewer", $content);
	return $content;
}

add_filter('get_the_content', 'dynpicwatermark_autoredirect_watermark', 999);
add_filter('the_content', 'dynpicwatermark_autoredirect_watermark', 999);
add_filter('the_excerpt', 'dynpicwatermark_autoredirect_watermark', 999);
add_filter('the_editor_content', 'dynpicwatermark_autoredirect_watermark', 1);
add_filter('the_editor', 'dynpicwatermark_autoredirect_watermark', 1);

 
function dynpicwatermark_image_attachment_fields_to_edit_get_alert_msg() {
	$message = '';
	if (get_option('dynpicwatermark_force_default_position') == 'true'){
		$message = ' * The Force default position option is active!<br>Post configuration will be applied only if it becames off!';
	} 
return $message;
}


function dynpicwatermark_image_attachment_fields_to_edit($form_fields, $post) {

	if (get_option('upload_path') == false) {
		$dynpicwatermark_wp_option_upload_path = 'wp-content/uploads';
	} else {
		$dynpicwatermark_wp_option_upload_path = get_option('upload_path');
	}
	
	if ( isset( $_GET['post_id'] ) ) {
		if ( substr($post->post_mime_type, 0, 5) == 'image' ) {
			$alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
			if ( empty($alt) )
				$alt = '';
			
			$form_fields['dynpicwatermark_marklocation'] = array(
				'label' => 'Local da marca:',
				'input' => 'html',
				'html'  => "
				<table><tr>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='XX'>No WaterMark</td>
					<td><input type='radio' checked=yes onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='NN'>Default Position</td>
				</tr></table>				
				<table><tr>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='TL'>top-left</td>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='TC'>top-center</td>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='TR'>top-right</td>
					</tr><tr>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='ML'>middle-left</td>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='MC'>middle-center</td>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='MR'>middle-right</td>
					</tr><tr>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='BL'>Bottom-left</td>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='BC'>Bottom-center</td>
					<td><input type='radio' onClick='dynpicwatermark_marklocation_change_pos$post->ID(this.value);' name='dynpicwatermark_marklocation_change_pos_rb_$post->ID' value='BR'>Bottom-right</td>
				</tr><tr>
					<td colspan=3>
						<div style='cursor:pointer; color:rgb(0,0,204); overflow:hidden; text-decoration:underline;' name='dynpicwatermark_Show_image_preview_link$post->ID' onclick='dynpicwatermark_Show_image_preview_link_f$post->ID();'>
							Show marked image preview
						</div>
						<div name='dynpicwatermark_hide_image_preview_link$post->ID' style='overflow:hidden; height:1px; visibility:hidden;'>
							<div style='cursor:pointer; color:rgb(0,0,204); text-decoration:underline;' onclick='dynpicwatermark_hide_image_preview_link_f$post->ID();'>Hide marked image preview</div>
							<img style='width:200px' name='dynpicwatermark_Show_image_preview_pic$post->ID' src=''><br>
							" . dynpicwatermark_image_attachment_fields_to_edit_get_alert_msg() . "
						</div>
					</td>
				</tr></table>
				<script type='text/javascript'>
							
					function dynpicwatermark_Show_image_preview_link_f$post->ID(newpos) {
						var dynpicwatermark_Show_image_preview_link=document.getElementsByName('dynpicwatermark_Show_image_preview_link$post->ID').item(0);
						var dynpicwatermark_Hide_image_preview_link=document.getElementsByName('dynpicwatermark_hide_image_preview_link$post->ID').item(0);
						dynpicwatermark_Show_image_preview_link.style.visibility='hidden';
						dynpicwatermark_Show_image_preview_link.style.height='1px';
						dynpicwatermark_Hide_image_preview_link.style.visibility='visible';
						dynpicwatermark_Hide_image_preview_link.style.height='auto';
					}
					
					function dynpicwatermark_hide_image_preview_link_f$post->ID(newpos) {
						var dynpicwatermark_Show_image_preview_link=document.getElementsByName('dynpicwatermark_Show_image_preview_link$post->ID').item(0);
						var dynpicwatermark_Hide_image_preview_link=document.getElementsByName('dynpicwatermark_hide_image_preview_link$post->ID').item(0);
						dynpicwatermark_Show_image_preview_link.style.visibility='visible';
						dynpicwatermark_Show_image_preview_link.style.height='auto';
						dynpicwatermark_Hide_image_preview_link.style.visibility='hidden';
						dynpicwatermark_Hide_image_preview_link.style.height='1px';
					}

					function dynpicwatermark_marklocation_change_pos$post->ID(newpos) {
					   var dynpicwatermark_marklocation_url=document.getElementsByName('attachments[$post->ID][url]').item(0);
					   var dynpicwatermark_image_preview_pic=document.getElementsByName('dynpicwatermark_Show_image_preview_pic$post->ID').item(0);
					   if (newpos == 'XX') {
						   dynpicwatermark_marklocation_url.value=dynpicwatermark_marklocation_url.value.replace(/([&?])position=../i,'$1position=XX');
						   dynpicwatermark_marklocation_url.value=dynpicwatermark_marklocation_url.value.replace('wp-content/plugins/dynpicwatermark/DynPicWaterMark_ImageViewer.php?position=XX&path=','" . $dynpicwatermark_wp_option_upload_path . "/');
					   } else {
						   dynpicwatermark_marklocation_url.value=dynpicwatermark_marklocation_url.value.replace('" . $dynpicwatermark_wp_option_upload_path . "/','wp-content/plugins/dynpicwatermark/DynPicWaterMark_ImageViewer.php?position=NN&path=');
						   dynpicwatermark_marklocation_url.value=dynpicwatermark_marklocation_url.value.replace(/([&?])position=../i,'$1position='+newpos);
					   }
					   dynpicwatermark_image_preview_pic.src=dynpicwatermark_marklocation_url.value;
					}
					dynpicwatermark_marklocation_change_pos$post->ID('NN');
				</script>
				"
			);

		}
	}
	return $form_fields;

}
add_filter('attachment_fields_to_edit', 'dynpicwatermark_image_attachment_fields_to_edit', 10, 2);

add_action('admin_menu', 'dynpicwatermark_plugin_menu');

function dynpicwatermark_plugin_menu() {
	add_options_page('DynPicWatermark Options', 'DynPicWatermark', 'administrator', __FILE__, 'dynpicwatermark_plugin_options',	plugins_url('/water.png', __FILE__));
  
	//call register settings function
	add_action( 'admin_init', 'dynpicwatermark_register_mysettings' );
}

function dynpicwatermark_register_mysettings() {
	register_setting( 'dynpicwatermark_group', 'dynpicwatermark_watermark_file' );
	register_setting( 'dynpicwatermark_group', 'dynpicwatermark_size_type' );
	register_setting( 'dynpicwatermark_group', 'dynpicwatermark_size_value' );
	register_setting( 'dynpicwatermark_group', 'dynpicwatermark_default_position' );
	register_setting( 'dynpicwatermark_group', 'dynpicwatermark_force_default_position' );
	register_setting( 'dynpicwatermark_group', 'dynpicwatermark_mark_any_image' );
	register_setting( 'dynpicwatermark_group', 'dynpicwatermark_memory_limit' );
}
function dynpicwatermark_plugin_options() {
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>
<h2>DynPicWatermark</h2>
<?php
if (get_option('upload_path') == false) {
		$dynpicwatermark_wp_option_upload_path = 'wp-content/uploads';
	} else {
		$dynpicwatermark_wp_option_upload_path = get_option('upload_path');
	}
	
if (isset($arquivo)) // Verificamos se a variável "arquivo" existe
{
$nome = rand(00,9999); // Aqui criamos um número randômico, para utilizarmos como nome do arquivo
$dir="up/"; //Esse é o diretório onde ficará os arquivos enviados, lembre-se de criá-lo. Este script não cria diretórios

if (is_uploaded_file($arquivo)) // Verificamos se existe algum arquivo na variável "Arquivo"
{ move_uploaded_file($arquivo,$dir.$nome.$arquivo_name); // Aqui, efetuamos o upload, propriamente dito
 echo "Enviado<br>"; // Caso dê tudo certo, imprimi na tela "enviado"
}else{
 echo "erro"; // Caso ocorra algum erro, imprimi na tela "erro"
}
}

?> DynPicWatermark plugin can WaterMark all images on posts once they exist in the wordpress "<?php _e('Miscellaneous Settings');?>"/"<?php _e('Uploading Files');?>" <span class="description">Actual value:<code><?php echo $dynpicwatermark_wp_option_upload_path; ?></code></span>

<script type='text/javascript'>
	function dynpicwatermark_watermark_preview_refresh(newmark) {
		var dynpicwatermark_watermark_preview_image=document.getElementsByName('dynpicwatermark_watermark_preview').item(0);
		dynpicwatermark_watermark_preview_image.src='<?php echo get_option('siteurl'); ?>/wp-content/plugins/dynpicwatermark/watermarks/'+newmark;
		var dynpicwatermark_watermark_preview_label_div=document.getElementsByName('dynpicwatermark_watermark_preview_label').item(0);
		dynpicwatermark_watermark_preview_label_div.innerHTML=newmark;
		
	}
</script>


<form method="post" action="options.php">
	<?php settings_fields( 'dynpicwatermark_group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Current Watermark Picture</th>
        <td>
		<span class="description">images should be manualy uploaded to <code>wp-content/plugins/dynpicwatermark/watermarks</code></span>
		<div style='width:700px;'>
			<div style='border: 2px black solid; text-align:center; width:320px; float:left;'>
				<div style='height:20px'>
				Current Watermark Picture
				</div>
				<img style='width:200px' src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/dynpicwatermark/watermarks/<?php echo get_option('dynpicwatermark_watermark_file');?>"><br>
				<span class="description"><?php echo get_option('dynpicwatermark_watermark_file');?></span>
			</div>
			<div style='border: 2px black solid; text-align:center; width:320px; float:right;'>
				<div style='height:20px'>
				Preview selected new watermark: <select name="dynpicwatermark_watermark_file" onchange='dynpicwatermark_watermark_preview_refresh(this.value);'>
				
				<?php 
					$dynpicwatermark_watermark_file_dir = dir(dirname(__FILE__).'/watermarks/');
					while (false !== ($dynpicwatermark_watermark_file_dir_entry = $dynpicwatermark_watermark_file_dir->read())) {
						if ($dynpicwatermark_watermark_file_dir_entry <> '..' and $dynpicwatermark_watermark_file_dir_entry <> '.' and 
							$dynpicwatermark_watermark_file_dir_entry <> preg_replace("/(gif|png)$/i",'',$dynpicwatermark_watermark_file_dir_entry)	){
						?>
						<option value="<?php echo $dynpicwatermark_watermark_file_dir_entry; ?>"<?php if (get_option('dynpicwatermark_watermark_file') == $dynpicwatermark_watermark_file_dir_entry) { echo ' Selected';} ?>><?php echo $dynpicwatermark_watermark_file_dir_entry; ?></option>
						<?php 
						}
					}
					$dynpicwatermark_watermark_file_dir->close();
				?>
					
				</select>
				</div>
				<img style='width:200px' id='dynpicwatermark_watermark_preview' name='dynpicwatermark_watermark_preview' src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/dynpicwatermark/watermarks/<?php echo get_option('dynpicwatermark_watermark_file');?>"><br>
				<span class="description"><div name="dynpicwatermark_watermark_preview_label" id="dynpicwatermark_watermark_preview_label"><?php echo get_option('dynpicwatermark_watermark_file');?></div></span>
			</div>
		</div>
		</td>
		
        </tr>
        <tr valign="top">
        <th scope="row">Watermark size type</th>
        <td><select name="dynpicwatermark_size_type">
			<option value="W"<?php if (get_option('dynpicwatermark_size_type') == 'W') { echo ' Selected';} ?>>Fixed Width</option>
			<option value="W%"<?php if (get_option('dynpicwatermark_size_type') == 'W%') { echo ' Selected';} ?>>% of Image Width</option>
			<option value="H"<?php if (get_option('dynpicwatermark_size_type') == 'H') { echo ' Selected';} ?>>Fixed Height</option>
			<option value="H%"<?php if (get_option('dynpicwatermark_size_type') == 'H%') { echo ' Selected';} ?>>% of Image Height</option>
			<option value="O"<?php if (get_option('dynpicwatermark_size_type') == 'O') { echo ' Selected';} ?>>Watermark Original size</option>
		</select></td>
        </tr>
        <tr valign="top">
        <th scope="row">Watermark size Value</th>
        <td><input type="text" name="dynpicwatermark_size_value" value="<?php echo get_option('dynpicwatermark_size_value'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Watermark Default Position</th>
        <td><select name="dynpicwatermark_default_position">
			<option value="TL"<?php if (get_option('dynpicwatermark_default_position') == 'TL') { echo ' Selected';} ?>>Top-Left</option>
			<option value="TC"<?php if (get_option('dynpicwatermark_default_position') == 'TC') { echo ' Selected';} ?>>Top-Center</option>
			<option value="TR"<?php if (get_option('dynpicwatermark_default_position') == 'TR') { echo ' Selected';} ?>>Top-Right</option>
			<option value="ML"<?php if (get_option('dynpicwatermark_default_position') == 'ML') { echo ' Selected';} ?>>Middle-Left</option>
			<option value="MC"<?php if (get_option('dynpicwatermark_default_position') == 'MC') { echo ' Selected';} ?>>Middle-Center</option>
			<option value="MR"<?php if (get_option('dynpicwatermark_default_position') == 'MR') { echo ' Selected';} ?>>Middle-Right</option>
			<option value="BL"<?php if (get_option('dynpicwatermark_default_position') == 'BL') { echo ' Selected';} ?>>Botton-Left</option>
			<option value="BC"<?php if (get_option('dynpicwatermark_default_position') == 'BC') { echo ' Selected';} ?>>Botton-Center</option>
			<option value="BR"<?php if (get_option('dynpicwatermark_default_position') == 'BR') { echo ' Selected';} ?>>Botton-Right</option>
		</select></td>
        </tr>
        <tr valign="top">
        <th scope="row">Watermark Force default Position?</th>
        <td><select name="dynpicwatermark_force_default_position">
			<option value="true"<?php if (get_option('dynpicwatermark_force_default_position') == 'true') { echo ' Selected';} ?>>Yes</option>
			<option value="false"<?php if (get_option('dynpicwatermark_force_default_position') == 'false') { echo ' Selected';} ?>>NO</option>
		</select>
		<span class="description">* this option forces the defined Default Position and ignores the position selected at post edit time.</span>
		</td>
        </tr>
		<tr valign="top">
        <th scope="row">Watermark all images?</th>
        <td><select name="dynpicwatermark_mark_any_image">
			<option value="true"<?php if (get_option('dynpicwatermark_mark_any_image') == 'true') { echo ' Selected';} ?>>Yes</option>
			<option value="false"<?php if (get_option('dynpicwatermark_mark_any_image') == 'false') { echo ' Selected';} ?>>NO</option>
		</select>
		<span class="description">* By default, the WaterMark is printed only to images that carry the the DynPicWatermark plugin on link. Enabling this will watermark every image of every post.</span>
		</td>
        </tr>
		<tr valign="top">
        <th scope="row">Memory limit (MB):</th>
        <td><select name="dynpicwatermark_memory_limit">
			<option value="0"<?php if (get_option('dynpicwatermark_memory_limit')+0 == 0) { echo ' Selected';} ?>>General Php.ini value</option>
			<option value="16"<?php if (get_option('dynpicwatermark_memory_limit')+0 == 16) { echo ' Selected';} ?>>16</option>
			<option value="32"<?php if (get_option('dynpicwatermark_memory_limit')+0 == 32) { echo ' Selected';} ?>>32</option>
			<option value="64"<?php if (get_option('dynpicwatermark_memory_limit')+0 == 64) { echo ' Selected';} ?>>64</option>
			<option value="128"<?php if (get_option('dynpicwatermark_memory_limit')+0 == 128) { echo ' Selected';} ?>>128</option>
		</select><br>
		<?php
			$dynpicwatermark_memory_limit_value = get_option('dynpicwatermark_memory_limit')+0;
			if ($dynpicwatermark_memory_limit_value == 0){
				unlink(dirname(__FILE__).'/php.ini');
			} else {
				$dynpicwatermark_local_phpini_file = fopen(dirname(__FILE__).'/php.ini', 'w');
				fwrite($dynpicwatermark_local_phpini_file, '[PHP]');
				fwrite($dynpicwatermark_local_phpini_file, 'memory_limit = ' . $dynpicwatermark_memory_limit_value . 'M');
				fclose($dynpicwatermark_local_phpini_file);
			} 
		?>
		
			<span class="description"> General PHP.ini Configuration:<?php echo ini_get("memory_limit"); ?> <br>
				<div  style="width:100%; height:25px;">DynPicWaterMark Viewer php.ini Configuration:<iframe scrolling="no" frameborder=0 marginheight=0 marginwidth=0 class="description" style="width:70px; height:25px; overflow:hidden;" src="<?php  echo get_option('siteurl').'/wp-content/plugins/dynpicwatermark/dynpicwatermark_memory_limit.php';?>"> </iframe><div>
				* if your option don't apply correctly. Check if your server configuration permit to have individual php.ini files for especific folders<BR>
				<br>
				Attention: In php, Images are created pixel by pixel and get larger sizes than original files. <br>
				If memory limit is going out of bounds you will be able to see it on "error_log" file at plugin folder.</span>
		</td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } 
?>