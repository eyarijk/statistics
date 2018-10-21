let step = 0;
let finalStep = 9;

$('#start').on('click',function () {
    step = 1;
    renderStep();
});

$('#restart').on('click',function () {
    step = 0;
    renderStep();
    $('#next,#save').prop('disabled',true)
});

$('#next').on('click',function () {
    step++;
    renderStep();
    if (checkData()) {
        $(this).prop('disabled',false);
    } else {
        $(this).prop('disabled',true);
    }

});

$('#prev').on('click',function () {
    step--;
    renderStep();
    $('#next').prop('disabled',false);
});

$('#save').on('click',function () {
    $('#steps').val(finalStep);
    let form = $('#steps-form');
    let dataReq = form.serialize();

    $.post("/", dataReq,function() {
        form[0].reset();
        $('.step,.nav--buttons').addClass('hidden');
        $('.step-final').removeClass('hidden');
    });
});

$('.form-check-input').on('click',function () {
    if (checkData()) {
        $('#next').prop('disabled',false);
        if (step === finalStep) {
            $('#save').prop('disabled',false);
        }
    } else {
        $('#next,#save').prop('disabled',true);
    }
});

function renderStep() {
    $('.step').addClass('hidden');
    $(`.step-${step}`).removeClass('hidden');

    let nextButton = $('#next');

    if (step > 0) {
        $('.nav--buttons').removeClass('hidden');
    } else {
        $('.nav--buttons').addClass('hidden');
    }

    if (step === 1) {
        $('#prev').addClass('hidden');
    } else {
        $('#prev').removeClass('hidden');
    }

    if (step === finalStep) {
        $('#save').removeClass('hidden');
        nextButton.addClass('hidden');
    } else {
        $('#save').addClass('hidden');
        nextButton.removeClass('hidden');
    }
}

function checkData() {
    let formData = $('#steps-form').serializeArray();

    let nameOfInput = $(`#step${step}-1`).attr('name');

    for (let item of formData) {
        if (item.name === nameOfInput) {
            return true;
        }
    }
    return false;
}

let body = $('body');

body.on('contextmenu', function(e){
    return false;
});

body.on('mousedown', function(e){
    return false;
});