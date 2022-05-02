import React from 'react';
import ReactDOM from 'react-dom';
import { Chart as ChartJS } from 'chart.js/auto'
import { Line } from 'react-chartjs-2';


function IncomeExpenditure() {
    const labels = ['Jan ','Feb', 'Mar', 'Apr','May', ' Jun', 'Jul', 'Aug', 'Sep',' Oct', 'Nov', 'Dec']

     const data = {
        labels,
        datasets: [
          {
            label: '2021',
            data:  [3,1,21,3,12,11,30,50],
            borderColor: 'rgb(53, 162, 235)',
            backgroundColor: 'rgba(53, 162, 235, 0.5)',
          },
          {
            label: '2022',
            data:  [13,51,50,30,28,45,10],
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
          },
        ],
      };

      const options = {
        responsive: true,

      };


    return (
       <Line data={data} options={options}/>
    );
}

export default IncomeExpenditure;

if (document.getElementById('inc-exp')) {
    ReactDOM.render(<IncomeExpenditure />, document.getElementById('inc-exp'));
}
