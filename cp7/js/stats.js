document.getElementById("year").addEventListener(
  "change",
  redreawChart,
  false
);

document.getElementById("emp").addEventListener(
    "change",
    redreawChart,
    false
);

//Redessine le chart
function redreawChart(){
    let eYear=document.getElementById('year');
    let eEmp=document.getElementById('emp');
    let eChart=document.getElementById('chart');
    eChart.src='chart.php?e='+eEmp.value+'&a='+eYear.value;
}
