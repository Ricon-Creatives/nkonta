
const checkValue = (elem,id) => {

   let selectedValue = elem.value;
   let idValue = document.getElementById(`${id}`);

    if (selectedValue == 5 || selectedValue == 16) {
        idValue.classList.remove('hidden');
        idValue.classList.add('block');
    }else{
        idValue.classList.add('hidden');
    }
}


//
function downloadCSVFile(csv, filename) {
	var csv_file, download_link;

	csv_file = new Blob([csv], {type: "text/csv"});

	download_link = document.createElement("a");

	download_link.download = filename;

	download_link.href = window.URL.createObjectURL(csv_file);

	download_link.style.display = "none";

	document.body.appendChild(download_link);

	download_link.click();
}

/************************CSV**************************** */
function htmlToCSV(id,filename) {
	var data = [];
	var rows = document.querySelectorAll(`#${id} tr`);

	for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");

		for (var j = 0; j < cols.length; j++) {
		        row.push(cols[j].innerText);
        }

		data.push(row.join(","));
	}

	downloadCSVFile(data.join("\n"), filename);
}

/***********************PDF ************************* */
function generate(id,filename,header) {
    var doc = new jsPDF('p', 'pt', 'letter');
    let title = document.getElementById(`${header}`).value;

    var htmlstring = '';
    var tempVarToCheckPageHeight = 0;
    var pageHeight = 0;
    pageHeight = doc.internal.pageSize.height;
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function(element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 150,
        bottom: 60,
        left: 30,
        right: 30,
        width: 650
    };
    var y = 20;
    doc.setLineWidth(2);
    doc.text(200, y = y + 30, `${title}`);
    doc.autoTable({
        html: `#${id}`,
        startY: 70,
        theme: 'striped',
        //columnStyles: {},
        styles: {
            minCellHeight: 40
        }
    })
    doc.save(`${filename}.pdf`);
}

/********************************************************* */
