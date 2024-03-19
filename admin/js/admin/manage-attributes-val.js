var code_ajax = $("#code_ajax").val();
var pageno = 1;

function getConfAttributeVal(pagenov) {
	$.busyLoadFull("show");
	var perpage = $('#perpage').val();
	var main_attribute_id = $('#main_attribute_id').val();

	var count = 1;
	$.ajax({
		method: 'POST',
		url: 'get-attribute-conf-val-data.php',
		data: {
			code: code_ajax,
			page: pagenov,
			perpage: perpage,
			main_attribute_id: main_attribute_id
		},
		success: function (response) {
			$.busyLoadFull("hide");
			var parsedJSON = $.parseJSON(response);
			$("#cat_list").empty();

			$("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
			$(".page_div").html(parsedJSON["page_html"]);

			var data = parsedJSON.data;
			$(data).each(function () {
				var color_icon = '';
				if (this.main_attr == 'Color') {
					var rgb = hexToRgb(this.attribute_value);
					var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
					var color_icon = '&nbsp;&nbsp;<label style="height:20px;width:20px;border-radius:20px;margin-bottom:-5px;background-color:' + this.attribute_value + ';border:1px solid ' + darkerColor + '"></label>';
				}
				var html = '<tr id="tr' + this.id + '"> <td>' + ((pagenov - 1) * perpage + count) + '</td><td > ' + this.main_attr + '</td><td > ' + this.attribute_value + color_icon + '</td>';
				html += '<td><div class="d-flex"><button type="submit" class= "btn btn-danger waves-effect waves-light btn-sm pull-left" name="delete" onclick=\'deletebrand(' + this.id + ',"' + this.attribute_value + '");\'>DELETE</button>';

				html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-success waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.attribute_value + '")\';>EDIT</button></div></td></tr>';
				$("#cat_list").append(html);

				count++;
			});



		}
	});
}


$(document).ready(function () {
	getConfAttributeVal(pageno);


	$("#add_attributes_btn").click(function (event) {
		event.preventDefault();

		var namevalue = $('#attributes').val();

		if (!namevalue) {
			successmsg("Please enter Attributes Name");
		}
		var main_attribute_id = $('#main_attribute_id').val();

		if (namevalue) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('main_attribute_id', main_attribute_id);
			form_data.append('type', 'add');
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'attribute-val-conf-process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#attributes').val('');
					getConfAttributeVal(1)
					successmsg(response);

				}
			});
		}

	});

	$("#update_attributes_btn").click(function (event) {
		event.preventDefault();

		var namevalue = $('#update_attributes').val();
		var attribute_id = $('#attribute_id').val();

		if (!namevalue) {
			successmsg("Please enter Attribute");
		}
		var main_attribute_id = $('#main_attribute_id').val();
		if (namevalue) {
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('namevalue', namevalue);
			form_data.append('attribute_id', attribute_id);
			form_data.append('main_attribute_id', main_attribute_id);
            form_data.append('type', 'edit');
			form_data.append('code', code_ajax);

			$.ajax({
				method: 'POST',
				url: 'attribute-val-conf-process.php',
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					$.busyLoadFull("hide");
					$("#myModalupdate").modal('hide');
					$('#update_attributes').val('');
					$('#attribute_id').val('');
					var page = $(".pagination .active .current").text();
					getConfAttributeVal(page);
					successmsg(response);

				}
			});
		}

	});



});

function editbrand(id, name) {
	$("#myModalupdate").modal('show');
	$("#attribute_id").val(id);
	$("#update_attributes").val(name);
}

function deletebrand(id, name) {
	var main_attribute_id = $('#main_attribute_id').val();
	xdialog.confirm('Are you sure want to delete?', function () {
		$.busyLoadFull("show");
		$.ajax({
			method: 'POST',
			url: 'attribute-val-conf-process.php',
			data: { deletearray: id, code: code_ajax, type: 'delete', main_attribute_id: main_attribute_id, namevalue: name },
			success: function (response) {
				$.busyLoadFull("hide");
				if (response == 'Failed to Delete.') {
					successmsg("Failed to Delete.");
				} else if (response == 'Deleted') {
					$("#tr" + id).remove();
					successmsg("Attribute Deleted Successfully.");
				} else {
					//$("#myModalbrandassign").modal('show');
					//$("#myModalbrandassigndivy").html(response);
					successmsg(response);
				}
                getConfAttributeVal(1);
			}
		});
	}, {
		style: 'width:420px;font-size:0.8rem;',
		buttons: {
			ok: 'yes ',
			cancel: 'no '
		},
		oncancel: function () {
			// console.warn('Cancelled!');
		}
	});
}


function back_page(id) {
	location.href = "manage-conf-attributes.php";
}