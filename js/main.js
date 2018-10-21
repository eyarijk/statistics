let step = 0;
let finalStep = 7;

$('#start').on('click',function () {
    step = 1;
    renderStep();
});

$('#restart').on('click',function () {
    step = 0;
    renderStep();
});

$('#next').on('click',function () {
    step++;
    renderStep();
});

$('#prev').on('click',function () {
    step--;
    renderStep();
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

function renderStep() {
    $('.step').addClass('hidden');
    $(`.step-${step}`).removeClass('hidden');

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
        $('#next').addClass('hidden');
    } else {
        $('#save').addClass('hidden');
        $('#next').removeClass('hidden');
    }
}
