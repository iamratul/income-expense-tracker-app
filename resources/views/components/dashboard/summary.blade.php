<div class="container-fluid">
    <div class="row">

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white shadow">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h3 class="mb-0 text-capitalize font-weight-bold" id="totalIncome"></h3>
                                <p class="mb-0 text-sm">Total Income</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-success shadow float-end border-radius-md">
                                <img class="w-100 " src="{{ asset('images/icon.svg') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white shadow">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h3 class="mb-0 text-capitalize font-weight-bold" id="totalExpense"></h3>
                                <p class="mb-0 text-sm">Total Expense</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-danger shadow float-end border-radius-md">
                                <img class="w-100 " src="{{ asset('images/icon.svg') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 bg-white shadow">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h3 class="mb-0 text-capitalize font-weight-bold" id="balance"></h3>
                                <p class="mb-0 text-sm">Balance</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-primary shadow float-end border-radius-md">
                                <img class="w-100 " src="{{ asset('images/icon.svg') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    displayTotal();
    async function displayTotal() {
        const resIncome = await axios.get("/total-income");
        const resExpense = await axios.get("/total-expense");

        const totalIncome = resIncome.data.totalIncome || 0;
        const totalExpense = resExpense.data.totalExpense || 0;
        const balance = totalIncome - totalExpense;

        document.getElementById("totalIncome").textContent = totalIncome;
        document.getElementById("totalExpense").textContent = totalExpense;
        document.getElementById("balance").textContent = balance;
    }
</script>