import React,{useEffect,useState} from 'react';
import ReactDOM from 'react-dom';
import { Chart as ChartJS } from 'chart.js/auto'
import { Pie } from 'react-chartjs-2';
import axios from 'axios'
import { left } from '@popperjs/core';

function Sales() {
    const [points, setPoints] = useState([])

    const formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });

    const labels = ['Credit','Cash']

     const data = {
        labels,
        datasets: [
          {
            label: 'Revenue',
            data:  [points.recievables,points.revenue],
            backgroundColor: ['rgba(53, 162, 235, 0.5)','rgba(253, 180 ,92, 100)'],
          },
        ],
      };

      const options = {
        responsive: true,
      };

      let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      useEffect(() => {
        axios.get('/income/home', {headers:{ 'X-CSRF-TOKEN':laravelToken }})
        .then((res) => {
            //console.log(res.data.result)
          console.log(res.data.data)

            setPoints(res.data.data)
     })
     .catch(function (error) {
         // handle error
         console.log(error);
     });
 }, [])

    return (
        <>
        <div className="p-2 items-center">
        <h3 className="font-bold text-center text-lg">Sales(GHS)</h3>
        <ul className="list-disc p-3 mt-5">
                <li className='flex justify-between'>
                    Credit
                     <span>{ formatter.format(points.recievables)}</span>
                    </li>
                    <li className='flex justify-between'>
                    Cash
                     <span>{formatter.format(points.revenue)}</span>
                    </li>
            </ul>
        </div>
        <div className="p-2 mx-1">
            <h3 className="font-bold text-center text-lg">Sales</h3>
            <div className="flex items-center justify-center mt-4 border-r sm:border-r-0">
                <div className="w-full">
                    <Pie data={data} options={options}/>
                </div>
            </div>
        </div>
        </>
    );
}

export default Sales;

if (document.getElementById('sales')) {
    ReactDOM.render(<Sales />, document.getElementById('sales'));
}
