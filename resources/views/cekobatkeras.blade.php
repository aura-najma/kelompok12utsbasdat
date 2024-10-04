<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cek Obat Keras</title>
    <style>
        body {
            background-color: rgba(34, 149, 180, 0.3);
        }
        .container {
            max-width: 800px;
            margin-top: 5rem;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
        }
        .left-side {
            flex: 1;
            text-align: center;
            margin-right: 20px;
        }
        .right-side {
            flex: 2;
        }
        .btn-add {
            background-color: #a4c757;
            color: white;
        }
        .btn-add:hover {
            background-color: #8fb54b;
        }
        .hard-drug-warning {
            color: red;
        }
        .apoteker-checkbox-container {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <h3 class="text-center text-custom">Foto Resep</h3>
            <img src="{{ asset('img/contohfotoresep.jpeg') }}" alt="Resep" style="max-width: 100%; border-radius: 10px;">
        </div>
        <div class="right-side">
            <h3 class="text-center text-custom">Cek Obat Keras</h3>
            <form id="medicationForm">
                <div id="medicationInputs">
                    <div class="mb-3">
                        <label for="medication1" class="form-label">Nama Obat 1</label>
                        <input type="text" class="form-control" id="medication1">
                        <div class="hard-drug-warning" id="warning1"></div>
                        <div class="apoteker-checkbox-container" id="checkboxContainer1">
                            <input type="checkbox" id="apoteker1" class="apoteker-checkbox"> Telah Disetujui
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="medication2" class="form-label">Nama Obat 2</label>
                        <input type="text" class="form-control" id="medication2">
                        <div class="hard-drug-warning" id="warning2"></div>
                        <div class="apoteker-checkbox-container" id="checkboxContainer2">
                            <input type="checkbox" id="apoteker2" class="apoteker-checkbox"> Telah Disetujui
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="medication3" class="form-label">Nama Obat 3</label>
                        <input type="text" class="form-control" id="medication3">
                        <div class="hard-drug-warning" id="warning3"></div>
                        <div class="apoteker-checkbox-container" id="checkboxContainer3">
                            <input type="checkbox" id="apoteker3" class="apoteker-checkbox"> Telah Disetujui
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-add" id="addMedication">Tambah Obat</button>
                <button type="submit" class="btn btn-custom w-100 mt-3" style="background-color: #2295B4; color: white;">Cek</button>
                <div id="validationButton" class="mt-3" style="display: none;">
                    <button type="button" class="btn btn-custom w-100" style="background-color: #a4c757; color: white;" onclick="window.location.href='{{ url('validasidokter') }}'">Ke Halaman Validasi Dokter</button>
                </div>
                <div id="stockButton" class="mt-3" style="display: none;">
                    <button type="button" class="btn btn-custom w-100" style="background-color: #a4c757; color: white;" onclick="window.location.href='{{ url('cekstokobat') }}'">Ke Halaman Cek Stok Obat</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const hardDrugs = ['Tremenza', 'Salbutamol', 'Coltin Dry Sirup'];
        let medicationCount = 3;

        document.getElementById('medicationForm').addEventListener('submit', function (e) {
            e.preventDefault();
            checkMedications();
        });

        document.getElementById('addMedication').addEventListener('click', function () {
            medicationCount++;
            const newInput = document.createElement('div');
            newInput.className = 'mb-3';
            newInput.innerHTML = `
                <label for="medication${medicationCount}" class="form-label">Nama Obat ${medicationCount}</label>
                <input type="text" class="form-control" id="medication${medicationCount}">
                <div class="hard-drug-warning" id="warning${medicationCount}"></div>
                <div class="apoteker-checkbox-container" id="checkboxContainer${medicationCount}" style="display: none;">
                    <input type="checkbox" id="apoteker${medicationCount}" class="apoteker-checkbox"> Apoteker
                </div>
            `;
            document.getElementById('medicationInputs').appendChild(newInput);
        });

        function checkMedications() {
            let hasHardDrug = false;
            let visibleCheckboxContainers = [];

            for (let i = 1; i <= medicationCount; i++) {
                const medicationInput = document.getElementById(`medication${i}`);
                const warningDiv = document.getElementById(`warning${i}`);
                const checkboxContainer = document.getElementById(`checkboxContainer${i}`);
                const medicationName = medicationInput.value.trim();

                if (medicationName && hardDrugs.includes(medicationName)) {
                    warningDiv.textContent = `${medicationName} adalah obat keras.`;
                    checkboxContainer.style.display = 'block';
                    hasHardDrug = true;
                    visibleCheckboxContainers.push(checkboxContainer);
                } else {
                    warningDiv.textContent = '';
                    checkboxContainer.style.display = 'none';
                }
            }

            if (hasHardDrug) {
                document.getElementById('validationButton').style.display = 'block';
                document.getElementById('stockButton').style.display = 'none';

                checkAllCheckboxes(visibleCheckboxContainers);
            } else {
                document.getElementById('validationButton').style.display = 'none';
                document.getElementById('stockButton').style.display = 'block';
            }
        }

        function checkAllCheckboxes(visibleCheckboxContainers) {
            let allChecked = visibleCheckboxContainers.every(container => {
                const checkbox = container.querySelector('.apoteker-checkbox');
                return checkbox.checked;
            });

            if (allChecked) {
                document.getElementById('validationButton').style.display = 'none';
                document.getElementById('stockButton').style.display = 'block';
            } else {
                document.getElementById('stockButton').style.display = 'none';
            }

            // Tambahkan event listener pada checkbox yang terlihat
            visibleCheckboxContainers.forEach(container => {
                const checkbox = container.querySelector('.apoteker-checkbox');
                checkbox.addEventListener('change', function () {
                    checkAllCheckboxes(visibleCheckboxContainers);
                });
            });
        }
    </script>
</body>
</html>
