
jQuery("#"+data_php.id).change(function(){
  jQuery('#qbttc_parent_taxonomy').addClass('hidden');
  
  var loader = jQuery( '<img/>', {
      src: data_php.siteurl+'/wp-admin/images/loading.gif',
      'class': 'loader-image'
  }).prependTo( jQuery('#qbttc_parent_taxonomy').closest('td') );
  
  var data = {
    action: 'qbt_select_change',
    'taxonomy': jQuery(this).val()
  };

  jQuery.post(ajaxurl, data, function(response) {
    if(response['success'] != false) {
      jQuery('#qbttc_parent_taxonomy').replaceWith(response);
      loader.remove();
    }
  });
});