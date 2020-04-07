$('.medicineContainer').delegate('button[type=button]', 'click', addMedRow);

function addMedRow() {
    const medPriceContainer = $('#medPriceContainer').clone()
    const addMedBtnContainer = $('#addMedBtnContainer').clone()
    const medQuantityContainer = $('#medQuanityContainer').clone()
    const medData = $('.medData').clone().removeClass('d-none medData')
    const typeData = $('.typeData').clone().removeClass('d-none typeData')
    
    $('<div></div>').addClass('col-4')
        .append('<label>Medicine Name</label>')
        .append(medData)
        .appendTo('.medicineRow')
    medData.select2({
        tags: true,
        placeholder: "Select a medicine name",
        allowClear:true

    })
    
    $('<div></div>').addClass('col-3')
    .append('<label>Medicine Type</label>')
    .append(typeData)
    .appendTo('.medicineRow')
    typeData.select2({
        tags: true,
        placeholder: "Select medicine type",
        allowClear:true

    })

    medPriceContainer.appendTo('.medicineRow')
    medQuantityContainer.appendTo('.medicineRow')
    addMedBtnContainer.appendTo('.medicineRow')
}


$('#userSelect').select2({
    placeholder: "Select user name ",
    allowClear:true

})
$('.medicineNameSelect').select2({
    tags: true,
    placeholder: "Select a medicine name",
    allowClear:true
})
$('.medicineTypeSelect').select2({
    tags: true,
    placeholder: "Select medicine type",
    allowClear:true
})
