// FILTER FUNCTION
document.addEventListener('DOMContentLoaded', function (event) {
    // let colHeaders = document.querySelectorAll('#employeeTable th');
    let colHeaders = document.querySelectorAll('.tblColText');

    colHeaders.forEach((colHeader, index) => {
        // if (index === 1 || index === 4 || index === 5 || index === 6) {
        //     colHeader.appendChild(generateDropdown(index));
        // }
        console.log('index is: ' + index + ', ' + colHeader.textContent);
        colHeader.appendChild(generateDropdown(index));
    });
});

function generateDropdown(index) {
    let columnData = [];
    let rows = document.querySelectorAll('#employeeTable tbody tr');
    // let rows = document.querySelectorAll('tr');
    rows.forEach((row, i) => {
        if (i == 0) {
            columnData.push('');
            return;
        }
        let cells = row.getElementsByTagName('td');
        columnData.push(cells[index].innerText);
    });
    // Remove duplicates
    let uniqColumnData = [...new Set(columnData)];
    // Generate the select option
    let select = document.createElement('select');

    uniqColumnData.map((data, i) => {
        let option = document.createElement('option');
        option.setAttribute('value', data);

        let optionText = document.createTextNode(data);
        option.appendChild(optionText);

        select.appendChild(option);
    });

    select.setAttribute('id', index);
    select.addEventListener('change', function () {
        filterTable(this.value, index);
        clearSelect(select.id);
    });

    return select;
}

function clearSelect(id) {
    let selects = document.querySelectorAll('select');
    selects.forEach((select, i) => {
        if (id != i) {
            select.value = '';
        }
    });
}

function filterTable(filter, index) {
    console.log(filter);
    const table = document.querySelector('#employeeTable');
    const rows = table.getElementsByTagName('tr');
    filter = filter.toUpperCase();

    // LOOP THROUGH ALL ROWS EXCEPT FOR HEADERS
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td')[index];

        if (cells) {
            txtValue = cells.textContent || cells.innerText;
            // if (filter === '') {
            //     rows[i].style.display = "";
            // } else {
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            // }
        }
    }
}

// SEARCH FUNCTION
// const searchInput = document.getElementById("search");
// const rows = document.querySelectorAll("tbody tr");

// searchInput.addEventListener("keyup", function (event) {
//     const q = event.target.value.toLowerCase();
//     rows.forEach((row) => {
//         let found = false;
//         row.querySelectorAll("td").forEach((cell) => {
//             if (cell.textContent.toLowerCase().includes(q)) {
//                 found = true;
//             }
//         });
//         row.style.display = found ? "table-row" : "none";
//     });
// });

function searchFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("#employeeTable");
    // tr = table.getElementsByTagName("tr");
    tr = document.querySelectorAll("tbody tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
