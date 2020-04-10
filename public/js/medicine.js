$('.medicineContainer').delegate('button.add', 'click', addMedRow);
$('.medicineContainer').delegate('button.delete', 'click', deleteMedRow);
$('.medicineContainer').delegate('.price', 'input', updateTotalPrice);
$('.medicineContainer').delegate('.quantity', 'input', updateTotalPrice);
const totalPriceSpan = document.querySelector('#totalPrice')
document.onload = updateTotalPrice()
function addMedRow() {
    const medPriceContainer = $('.medPriceContainer').first().clone().removeClass('medPriceContainer')
    const addMedBtnContainer = $('.addMedBtnContainer').first().clone().removeClass('addMedBtnContainer')
    const medQuantityContainer = $('.medQuanityContainer').first().clone().removeClass('medQuanityContainer')
    medQuantityContainer.children('input').val('').addClass('quantity')
    medPriceContainer.children('input').val('')
    medPriceContainer.children('input').val('').addClass('price')
    const medData = $('.medData').clone().removeClass('d-none medData')
    const typeData = $('.typeData').clone().removeClass('d-none typeData')
    const medicineContainer = $('.medicineContainer').last()
    const medicineRow=$('<div></div>').addClass('row')

    $('<div></div>').addClass('col-4')
        .append('<label>Medicine Name</label>')
        .append(medData)
        .appendTo(medicineRow)

    $('<div></div>').addClass('col-3')
        .append('<label>Medicine Type</label>')
        .append(typeData)
        .appendTo(medicineRow)

        medQuantityContainer.appendTo(medicineRow)
        medPriceContainer.appendTo(medicineRow)
        addMedBtnContainer.appendTo(medicineRow)
        medicineRow.appendTo(medicineContainer)
        
        medData.select2({
            tags: true,
            placeholder: "Select a medicine name",
            allowClear: true
            
        })
        typeData.select2({
            tags: true,
            placeholder: "Select medicine type",
            allowClear: true
    
        })

    
}


$('#userSelect').select2({
    placeholder: "Select user name ",
    allowClear: true

})
$('.medicineNameSelect').select2({
    tags: true,
    placeholder: "Select a medicine name",
    allowClear: true
})
$('.medicineTypeSelect').select2({
    tags: true,
    placeholder: "Select medicine type",
    allowClear: true
})


function updateTotalPrice() {
    const quantities=document.querySelectorAll('.quantity')
    const prices=document.querySelectorAll('.price')
    let totalPrice = 0;
    for (let i = 0; i < quantities.length; i++) {
        totalPrice += +quantities[i].value * +prices[i].value;
    }
    totalPriceSpan.innerText = totalPrice + ' $'
}

function deleteMedRow(e)
{
    $(this).parent().parent().remove()
}

$('carousel').carousel('pause')
