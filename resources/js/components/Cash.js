import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import { Chart as ChartJS } from "chart.js/auto";
import { Bar } from "react-chartjs-2";
import axios from "axios";

const Cash = () => {
    const [points, setPoints] = useState([]);

    const formatter = new Intl.NumberFormat("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });

    useEffect(() => {
        axios
            .get("/cash/home")
            .then((res) => {
                setPoints(res.data);
                setOne(points.bank1);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
    }, []);

    const labels = ["Bank 1 ", "Bank 2", "Petty Cash"];

    const data = {
        labels,
        datasets: [
            {
                label: "",
                data: [points.bank1, points.bank2, points.cash],
                borderColor: "rgb(53, 162, 235)",
                backgroundColor: "rgba(53, 162, 235, 0.5)",
            },
        ],
    };

    const options = {
        responsive: true,
    };

    return (
        <>
            <div className="p-2 justify-center">
                <ul className="list-disc p-3 mt-5">
                    <li className="flex justify-between ">
                        Bank 1<span>{formatter.format(points.bank1)}</span>
                    </li>
                    <li className="flex justify-between ">
                        Bank 2<span>{formatter.format(points.bank2)}</span>
                    </li>
                    <li className="flex justify-between ">
                        Petty Cash
                        <span>{formatter.format(points.cash)}</span>
                    </li>
                </ul>
            </div>
            <div className="col-span-2 p-4 mx-4">
                <h3 className="font-bold text-center text-lg">Cash</h3>
                <div className="flex items-center justify-center mt-4 border-r sm:border-r-0">
                    <div className="w-full">
                        <Bar data={data} options={options} />
                    </div>
                </div>
            </div>
        </>
    );
};

export default Cash;

if (document.getElementById("cash")) {
    ReactDOM.render(<Cash />, document.getElementById("cash"));
}
