function addColumn()
{//Adds a new column to the card grid
    var columnCount = document.querySelectorAll('#cardgrid tr th').length;

    if(columnCount >= title_maxamount+2)
    {
        alert("You can't add more Categories");
        return;
    }

    [...document.querySelectorAll('#cardgrid tr')].forEach((row, i) =>
    {
        let input = document.createElement("input");
        input.type = "text";
        input.className = "form-control";
        input.placeholder = (i ? "Dataset" : "Title");
        input.maxLength = (i ? dataset_maxlength : title_maxlength);
        input.required = true;
        input.name = (i ? "dataset["+(i-1)+"]["+(row.childElementCount-2)+"]" : "titles[]");

        let cell = document.createElement(i ? "td" : "th");
        cell.appendChild(input);
        row.appendChild(cell);
    });
}

function removeColumn()
{//Removes the last column of the card grid
    var tableColumns = document.getElementById('cardgrid').getElementsByTagName('tr');

    if(tableColumns[0].childElementCount > title_minamount+2)
    {
        for(let i = 0;i < tableColumns.length;i++)
        {
            tableColumns[i].removeChild(tableColumns[i].lastChild);
        }
    }
}

function addDataset()
{//Adds a new dataset to the card grid
    var tableRef = document.getElementById('cardgrid').getElementsByTagName('tbody')[0];
    var newRow = tableRef.insertRow(tableRef.rows.length);
    var thcount = document.getElementById('cardgrid').tHead.children[0].childElementCount;

    for(let i = thcount;i > 0;i--)
    {
        let newCell = newRow.insertCell(0);
        let input = document.createElement("input");

        switch(i)
        {
            case 1:
                input.type = "file";
                input.name = "imagefile[]";
                input.accept = "image/jpeg";
                input.onchange = validateFiletype;
                break;
            case 2:
                input.type = "text";
                input.placeholder = "Description";
                input.maxLength = desc_maxlength;
                //input.name="description["+(newRow.rowIndex-1)+"]";
                input.name = "description[]";
                break;
            default:
                input.type = "text";
                input.placeholder = "Dataset";
                input.maxLength = dataset_maxlength;
                input.name = "dataset["+(newRow.rowIndex-1)+"]["+(i-3)+"]";
                break;
        }

        input.className = "form-control";
        input.required = true;
        newCell.appendChild(input);
    }
}

function removeDataset()
{//Removes the last dataset of the card grid
    var tableRef = document.getElementById('cardgrid');
    var datasetcount = tableRef.querySelector('tbody').childElementCount;

    if(datasetcount > dataset_minamount)
    {
        tableRef.querySelector('tbody').deleteRow(datasetcount-1);
    }
}

function validateFiletype(el)
{//Validates the file type of the selected card image
    if(typeof el.value === 'undefined')
    {
        el = this;
    }

    if(["jpg", "jpeg"].includes(getFileExtension(el.value.toLowerCase())) == false)
    {
        alert('Invalid file format!');
        el.value = '';
    }
}

function getFileExtension(filename)
{//Returns the file extension of the given file
    return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
}