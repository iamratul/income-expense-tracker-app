<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Income</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="incomeCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" id="incomeAmount">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="incomeDescription">
                                <label class="form-label">date</label>
                                <input type="date" class="form-control" id="incomeDate">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn btn-sm  btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    FillCategoryDropDown();

    async function FillCategoryDropDown() {
        let res = await axios.get("/income-category-list")
        res.data.forEach(function(item, i) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#incomeCategory").append(option);
        })
    }

    async function Save() {

        let incomeCategory = document.getElementById('incomeCategory').value;
        let incomeAmount = document.getElementById('incomeAmount').value;
        let incomeDescription = document.getElementById('incomeDescription').value;
        let incomeDate = document.getElementById('incomeDate').value;

        if (incomeCategory.length === 0) {
            errorToast("Income Category is Required !")
        } else if (incomeAmount.length === 0) {
            errorToast("Income Amount is Required !")
        } else if (incomeDescription.length === 0) {
            errorToast("Income Description is Required !")
        } else if (incomeDate.length === 0) {
            errorToast("Income Date is Required !")
        } else {
            document.getElementById('modal-close').click();

            showLoader();
            let res = await axios.post("/create-income", {
                category_id: incomeCategory,
                amount: incomeAmount,
                description: incomeDescription,
                date: incomeDate
            })
            hideLoader();

            if (res.status === 201) {
                successToast('Income Created Successfully');
                document.getElementById("save-form").reset();
                await getList();
            } else {
                errorToast("Income Not Created !")
            }
        }
    }
</script>