const medicineContainer = document.querySelector('.medicineContainer');
const medicineRow = document.querySelector('.medicineRow');
const addMedBtn = document.querySelector('#addMedBtn');

const row = `<div class="row medicineRow">
                <div class="col-4">
                    <label for="exampleFormControlInput1">Medicine Name</label>
                    <input type="text" name="med_name[]" class="form-control mb-4" >
                </div>
                <div class="col-3">
                    <label for="">Medicine Type</label>
                    <input type="text" name="med_type[]" class="form-control mb-4" >
                </div>
                <div class="col-2">
                    <label for="">Quantity</label>
                    <input type="number" name="med_quantity[]" class="form-control mb-4" >
                </div>
                <div class="col-2">
                    <label for="">Price</label>
                    <input type="number" name="med_price[]"class="form-control mb-4" >
                </div>
                <div class="col-1 my-4">
                     <button class="btn btn-success" class="addMedBtn" type="button">+</button>
                </div>
            </div>`
$('.medicineContainer').delegate('button[type=button]', 'click', addMedRow);

function addMedRow() {
    $('.medicineContainer').append(row);
    console.log($('.addMedBtn'));

}
