$(document).ready(function(){
    $('.modal').modal();
    $('.dropdown-trigger').dropdown();
 });

 const quiz= document.querySelector('Average_of_Quiz-input');
 const act= document.querySelector('Average_of_Activities-input');
 const ass= document.querySelector('Average_of_Assignments-input');

 const ctx = document.getElementById('myChart').getContext('2d');
 let myChart = new Chart(ctx,{

    type: 'pie',
    data: {
        labels : ['Average Quizes', 'Average Activities', 'Average Assignments'],
        datasets : [
            {
                label: '# of votes',
                data: [0,0,0],
                backgroundColor: ['#2adece','#dd3b78', '#ff766b'],
                borderWidth: 1
            }
        ]
    }

 });

 const updateChartValue = (input, dataOrder)=> {

    input.addEventListener( 'change', e =>{
        myChart.data.dataset[0].data[dataOrder] = e.target.value;
        myChart.update();    
    });

 };

 updateChartValue(quiz, 0);
 updateChartValue(act, 1);
 updateChartValue(ass, 2);

 

