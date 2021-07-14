<section id="products" class="gray-section p-w-xl">
	<div class="row">
		<div class="col-lg-12 text-center">
			<div class="navy-line"></div>
			<h1>Product List</h1>
			<p>Some of the products from our customers</p>
		</div>
		<div class="row" id="product-list"></div>
	</div>
</section>
<script>

$(document).ready(function () {

	var product_list = $('#product-list');
	$('#navbar-item').html(`
		<li><a class="nav-link page-scroll" href="#page-top">Products</a></li>
	`)
    
	initNavbar(0);

  var dataProduct = {}

  $.when(getAllProduct()).then((e) =>{
  }).fail((e) => { console.log(e) });

  function getAllProduct(){
    swal({title: 'Loading product...', allowOutsideClick: false});
    swal.showLoading();
    return $.ajax({
      url: `<?php echo site_url('ProductController/getAll/')?>`, 'type': 'GET',
      data: {},
      success: function (data){
        swal.close();
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataProduct = json['data'];
        renderProduct(dataProduct);
      },
      error: function(e) {}
    });
  }

  function renderProduct(data){
    if(data == null || typeof data != "object"){
      console.log("Product::UNKNOWN DATA");
      return;
    }

    product_list.empty();
    Object.values(data).forEach((product) => {
      product_list.append(`
        <div class="col-sm-3">
          <div class="ibox product-box" style="cursor:pointer" onclick="location.href='<?=site_url('product?id_product=');?>${product['id_product']}'">
            <div class="ibox-title">
              <h5>${product['nama_product']}</h5>
            </div>
            <div>
              <div class="ibox-content no-padding border-left-right">
                <div class="product-item" style="background-image:url('<?=base_url('uploads/cover_product/')?>${product['cover_product']}')"></div>
              </div>
              <div class="ibox-content profile-content">
                <h4><strong>${product['nama_perusahaan']}</strong></h4>
                <p>${product['deskripsi_product']}</p>
              </div>
            </div>
          </div>
        </div>
      `);
    });
  }
});
</script>

</body>
</html>
