'use strict'
let data = [
    {
        "idnya": "1",
        "soalnya": "SOAL 1",
        "jawaban_a": "A",
        "jawaban_b": "B",
        "jawaban_c": "C",
        "jawaban_d": "D",
        "jawaban_e": "E",
        "pembahasannya": "PEMBAHASAN",
        "kuncinya": "A"
    },
    {
        "idnya": "2",
        "soalnya": "SOAL 2",
        "jawaban_a": "A",
        "jawaban_b": "B",
        "jawaban_c": "C",
        "jawaban_d": "D",
        "jawaban_e": "E",
        "pembahasannya": "PEMBAHASAN",
        "kuncinya": "A"
    },
    {
        "idnya": "3",
        "soalnya": "SOAL 3",
        "jawaban_a": "A",
        "jawaban_b": "B",
        "jawaban_c": "C",
        "jawaban_d": "D",
        "jawaban_e": "E",
        "pembahasannya": "PEMBAHASAN",
        "kuncinya": "A"
    },
    {
        "idnya": "4",
        "soalnya": "SOAL 4",
        "jawaban_a": "A",
        "jawaban_b": "B",
        "jawaban_c": "C",
        "jawaban_d": "D",
        "jawaban_e": "E",
        "pembahasannya": "PEMBAHASAN",
        "kuncinya": "A"
    },
    {
        "idnya": "5",
        "soalnya": "data:image",
        "jawaban_a": "A",
        "jawaban_b": "B",
        "jawaban_c": "C",
        "jawaban_d": "D",
        "jawaban_e": "E",
        "pembahasannya": "PEMBAHASAN",
        "kuncinya": "A"
    }
]

let list_header = ['NO', 'SOAL'];
let param_header = ['idnya', 'soalnya', 'jawaban_a', 'jawaban_b', 'jawaban_c', 'jawaban_d', 'jawaban_e', 'kuncinya', 'pembahasannya'];
/*
table :{
    headerRows:1,
    body:[
        [],
        [],
        [],
    ]
}
*/

let testing = build_test(data, param_header, list_header);
console.log(testing);
function build_test(data, columns, list) {
    let body = [];

    body.push(list);
    data.forEach(function (row) {
        var dataRow = [];
        var soalbahas = '';
        columns.forEach(function (column) {
            if (column === 'idnya') {
                dataRow.push(row[column]);
            }else if (column === 'pembahasannya') {
                soalbahas += 'PEMBAHASAN : ' + row[column].toString() + '\n';
            }else if(column === 'kuncinya'){
                soalbahas += 'KUNCI : ' + row[column].toString() + '\n';
            } else {
                soalbahas += row[column].toString() + '\n';
            }
        })
        dataRow.push(soalbahas);
        body.push(dataRow);
    });

    return body;
}