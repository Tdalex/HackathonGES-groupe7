(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
// Add Record
function addRecord(action) {
    // Add record
    $.post("ajax/addRecord/", {
		action:           action,
		quantity:         $("#quantity").val(),
		type:             $("#type").val(),
		job:              $("#job").val(),
		description:      $("#description").val(),
		wording:          $("#wording").val(),
		timeout:          $("#timeout").val(),
		name:             $("#name").val(),
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");
        
		// read records again
        readRecords(action);
    });
}

function addRecordQCM(action) {
    // Add record
    $.post("ajax/addRecord/", {
		action:           action,
		type:             'QCM',
		job:              $("#QCM_form #job").val(),
		wording:          $("#QCM_form #wording").val(),
		text_answer:      $.map($("#QCM_form .text_answer"), function (el) { return el.value; }),
		is_answer:        $.map($("#QCM_form .is_answer:checked"), function (el) { return el.value; }),
    }, function (data, status) {
        // close the popup
        $("#add_new_closed_question").modal("hide");
		
        // read records again
        readRecords(action);
    });
}

function addRecordOpen(action) {
    // Add record
    $.post("ajax/addRecord/", {
		action:           action,
		type:             'open',
		job:              $("#open_form #job").val(),
		wording:          $("#open_form #wording").val(),
		answer:           $("#open_form #answer").val(),
    }, function (data, status) {
        // close the popup
		$("#add_new_opened_question").modal("hide");
		
        // read records again
        readRecords(action);
    });
}

// READ records
function readRecords(type) {
	
	//reset forms
	$('input').val('');
	$('input').filter(':checkbox').prop('checked',false);
	
    $.post('ajax/getRecord/', {
		action: type,
	}, function (data, status) {
        $(".records_content").html(data);
        showDatatable();

    });
}


function deleteRecord(type, id) {
    var conf = confirm("Voulez vous vraiment supprimer cet element ?");
    if (conf == true) {
        $.post("ajax/deleteRecord", {
                id:   id,
				type: type
            },
            function (data, status) {
                // reload by using readRecords();
                readRecords(type);
            }
        );
    }
}

function GetDetails(type, id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/getDetails/", {
			type: type,
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
			$(".detail_content").html(data);
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateUserDetails() {
    // get values
    var first_name = $("#update_first_name").val();
    var last_name = $("#update_last_name").val();
    var email = $("#update_email").val();

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
            id: id,
            first_name: first_name,
            last_name: last_name,
            email: email
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}

$(document).on('click', '.getdetail', function() {
	GetDetails($(this).data('type'), $(this).data('id'));
});

$(document).on('click', '.addRecord', function() {
	addRecord($(this).data('type'));
});

$(document).on('click', '.addRecordQCM', function() {
	addRecordQCM($(this).data('type'));
});
$(document).on('click', '.addRecordOpen', function() {
	addRecordOpen($(this).data('type'));
});

$(document).on('click', '.deleteRecord', function() {
	deleteRecord($(this).data('type'), $(this).data('id'));
});


function HideShowConnectSignUp() {
    $("#form_connexion").hide();
    $("#form_inscription").hide();
    $("#inscription").click(function(){ $("#form_inscription").show(); $("#form_connexion").hide(); });
    $("#connexion").click(function(){ $("#form_inscription").hide(); $("#form_connexion").show(); });
}

function HideShowStepSignUp() {
    $("#s1_next").click(function() { $("#step1").hide(); $("#step2").show(); });
    $("#s2_prev").click(function() { $("#step1").show(); $("#step2").hide(); });
    $("#s2_next").click(function() { $("#step2").hide(); $("#step3").show(); });
    $("#s3_prev").click(function() { $("#step2").show(); $("#step3").hide(); });
}

function showDatatable(){
    $("#game").DataTable({
        columns: [
            { title: "Nom" },
            { title: "Email" },
            { title: "Poste" },
            { title: "Score" },
            { title: "Date" },
            { title: "Terminé ?" },
            { title: "Détail" }
        ]
    } );

    $("#candidate").DataTable({
        columns: [
            { title: "Nom" },
            { title: "Email" },
            { title: "Détail" }
        ]
    });

    $("#poste").DataTable({
        columns: [
            { title: "Nom" },
            { title: "Durée avant nouvel essai" },
            { title: "Quantité disponible" },
            { title: "Modifier" },
            { title: "Supprimer" }
        ]
    });

    $("#skill").DataTable({
        columns: [
            { title: "Nom" },
            { title: "Type" },
            { title: "Modifier" },
            { title: "Supprimer" }
        ]
    });

    $("#question").DataTable(
        {
        columns: [
            { title: "Enoncé" },
            { title: "Type" },
            { title: "Poste" },
            { title: "Modifier" },
            { title: "Supprimer" },
        ]
    }
    );
}

$(document).ready(function () {
	if($('.CRUD').length > 0)
		readRecords($('.CRUD').data('type'));
	if($('.CRUD').length > 0)
		readRecords($('.CRUD').data('type')); 
	
    $("#step1").show();
    $("#step2").hide();
    $("#step3").hide();
    HideShowStepSignUp();
    HideShowConnectSignUp();

});
},{}]},{},[1])