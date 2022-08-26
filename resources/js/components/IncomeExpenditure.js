import React,{useEffect,useState} from 'react';
import ReactDOM from 'react-dom';
import { Chart as ChartJS } from 'chart.js/auto'
import { Line } from 'react-chartjs-2';
import axios from 'axios'
import { left } from '@popperjs/core';

function IncomeExpenditure() {
    const [points, setPoints] = useState([])
    const [credit, setCredit] = useState([])
    const [debit, setDebit] = useState([])

    const formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });

   function groupBy(arr, property) {
    return arr.reduce((acc, cur) => {
      acc[cur[property]] = [...(acc[cur[property]] || []), cur];
      return acc;
    }, {});
  }


  function difference(myFirstObjArray, mySecondObjArray){
    let firstArray = [];
    myFirstObjArray.forEach((obj)=>{
     let match = false;
     mySecondObjArray.map((ele) => {
        if(obj.name === ele.name){
                match = true;
                return
            }
     })
     if(!match){
       firstArray.push({'name': obj.name,'total':obj.total,'type':obj.type});
     }
    });

    return firstArray;
 }

 //console.log(arr);

  function mergeArrayObjects(arr,debit,credit){
    let tempArr = arr.map((item) => {
        return {
          name: item.name,
          credit: (item.type == 'credit') ? item.total : 0,
          debit: (item.type == 'debit') ? item.total : 0,
        };
      });

    let left = debit.map((item) => {
        return {
            name: item.name,
          debit: item.total,

        };
      });

      //Create newn dormant object
      let right = credit.map((item) => {
        return {
            name: item.name,
            credit: item.total,

        };
      });

    const map = new Map();
  tempArr.forEach((item) => map.set(item.name, item));
  left.forEach((item) =>
   map.set(item.name, {...map.get(item.name), ...item}))
  right.forEach((item) =>
    map.set(item.name, { ...map.get(item.name), ...item })
  );
  const mergedArr = Array.from(map.values());
  return mergedArr;
  }

 // let newArray = mergeArrayObjects(arr,debit,credit)
  //console.log(newArray)


  let labelPoints = []
  let revenuePoints =[]
  let expensePoints =[]

  const setLabels  = () => {
    points.map((ele) => {
          //console.log(ele.name)
          labelPoints.push(ele.name)
      })
  }

  const setRevenue = () => {
    points.map((ele) => {
              revenuePoints.push(ele.debit)
              //console.log(ele.name)
      })
  }

  const setExpense = () => {
    points.map((ele) => {
          expensePoints.push(ele.credit)
              //console.log(ele.name)
      })
  }

 setLabels()
 setExpense()
 setRevenue()

    const labels = labelPoints

     const data = {
        labels,
        datasets: [
          {
            label: 'Revenue',
            data:  revenuePoints,
            borderColor: 'rgb(53, 162, 235)',
            backgroundColor: 'rgba(53, 162, 235, 0.5)',
          },
          {
            label: 'Expense',
            data:  expensePoints,
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
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
            console.log(res.data.result)
            let result = groupBy(res.data.result,'type')
            setCredit(result.credit)
            setDebit(result.debit)

            let arr = [
                ...difference(result.credit, result.debit),
                ...difference(result.debit, result.credit)
              ];

            let newArray = mergeArrayObjects(arr,result.debit,result.credit)
            //console.log(newArray)
            setPoints(newArray)
     })
     .catch(function (error) {
         // handle error
         console.log(error);
     });
 }, [])

    return (
        <>
        <div className="p-2 items-center">
        <div className="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div className="overflow-hidden">
              <table className="min-w-full">
                <thead className="bg-white border-b border-gray-300">
                  <tr>
                    <th className="text-sm font-bold text-gray-900 py-2 text-left">
                    </th>
                    {labelPoints.map((ele,i) => (
                    <th key={i} className="text-sm font-bold text-gray-900 py-2 text-left">
                        {ele}
                      </th>
                    ))}
                  </tr>
                </thead>
                <tbody>

                    <tr className="bg-white border-b">
                      <td className="py-1 whitespace-nowrap text-sm font-medium text-gray-900">
                      Revenue (GHS)
                      </td>
                      {revenuePoints.map((ele,i) => (
                    <th key={i} className="text-sm font-bold text-gray-900 py-2 text-left">
                        {formatter.format(ele)}
                      </th>
                    ))}
                    </tr>
                    <tr className="bg-white border-b">
                      <td className="py-1 whitespace-nowrap text-sm font-medium text-gray-900">
                      Expense (GHS)
                      </td>
                      {expensePoints.map((ele,i) => (
                    <th key={i} className="text-sm font-bold text-gray-900 py-2 text-left">
                        {formatter.format(ele)}
                      </th>
                    ))}
                    </tr>
                    </tbody>
                    </table>
                    </div>
                    </div>
        </div>
        <div className="p-2 mx-1">
            <h3 className="font-bold text-center text-lg">Revenue / Expense</h3>
            <div className="flex items-center justify-center mt-4 border-r sm:border-r-0">
                <div className="w-full">
                    <Line data={data} options={options}/>
                </div>
            </div>
        </div>
        </>
    );
}

export default IncomeExpenditure;

if (document.getElementById('inc-exp')) {
    ReactDOM.render(<IncomeExpenditure />, document.getElementById('inc-exp'));
}
