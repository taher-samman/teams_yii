(function ($) {
    $(document).ready(function () {
        var helperModal = document.getElementById('helper-modal');
        helperModal.addEventListener('hide.bs.modal', function (event) {
            $('#helper-modal .modal-body').html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
        })
        var helperOffcanvas = document.getElementById('helper-offcanvas')
        helperOffcanvas.addEventListener('hide.bs.offcanvas', function () {
            $('#helper-offcanvas .offcanvas-body').html('<h1>Loading...</h1><i class="fa-spin display-1 m-auto fa fa-refresh"></i>');
        })
    })
})(jQuery);

function onClickRowInstitution(e) {
    var parentTd = e.parentElement;
    var parentTr = parentTd.parentElement;
    var tbody = parentTr.parentElement;
    var id = tbody.dataset['institution'];
    var colleges = tbody.querySelectorAll('.colleges');
    if (colleges.length > 0) {
        colleges.forEach(element => {
            element.remove();
        });
    } else {
        (function ($) {
            $.ajax({
                type: 'GET',
                url: urls['getColleges'],
                data: {
                    id: id
                },
                success: function (data) {
                    var tr = document.createElement("tr");
                    tr.className = 'colleges';
                    tr.innerHTML = data;
                    tbody.appendChild(tr);
                },
                error: function (data) {
                    console.log(data);
                    alert("Error occured.please try again");
                },
                dataType: 'html'
            });
        })(jQuery);
    }
}

function addCollegeForm(e) {
    var id = e.dataset['institution'];
    (function ($) {
        $.ajax({
            type: 'GET',
            url: urls['addCollegeForm'],
            data: {
                id: id
            },
            success: function (data) {
                $('#helper-modal .modal-body').html(data['html']);
                eval(eval(`\`${data['js']}\``));
            },
            error: function (data) {
                console.log(data);
                alert("Error occured.please try again");
            },
            dataType: 'json'
        });
    })(jQuery);
}

function editCollegeForm(e) {
    var id = e.dataset['college'];
    (function ($) {
        $.ajax({
            type: 'GET',
            url: urls['editCollegeForm'],
            data: {
                id: id
            },
            success: function (data) {
                $('#helper-modal .modal-body').html(data);
            },
            error: function (data) {
                console.log(data);
                alert("Error occured.please try again");
            },
            dataType: 'html'
        });
    })(jQuery);
}

function editInstitutionForm(e) {
    var id = e.dataset['institution'];
    (function ($) {
        $.ajax({
            type: 'GET',
            url: urls['editInstitutionForm'],
            data: {
                id: id
            },
            success: function (data) {
                $('#helper-modal .modal-body').html(data);
            },
            error: function (data) {
                console.log(data);
                alert("Error occured.please try again");
            },
            dataType: 'html'
        });
    })(jQuery);
}

function manageCollegesContent(e) {
    var id = e.dataset['college'];
    (function ($) {
        $.ajax({
            type: 'GET',
            url: urls['contentManagement'],
            data: {
                id: id
            },
            success: function (data) {
                $('#helper-offcanvas .offcanvas-body').html(data);
            },
            error: function (data) {
                console.log(data);
                alert("Error occured.please try again");
            },
            dataType: 'html'
        });
    })(jQuery);
}



function addSpecializationForm(e) {
    var id = e.dataset['college'];
    (function ($) {
        $.ajax({
            type: 'GET',
            url: urls['addSpecializationForm'],
            data: {
                id: id
            },
            success: function (data) {
                $('#helper-modal .modal-body').html(data);
            },
            error: function (data) {
                console.log(data);
                alert("Error occured.please try again");
            },
            dataType: 'html'
        });
    })(jQuery);
}