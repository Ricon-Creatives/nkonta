import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import { parseInt } from "lodash";
import swal from 'sweetalert';

const Account = () => {
    const [accounts, setAccounts] = useState([])
    const [data, setData] = useState([])
    const [name, setName] = useState('')
    const [type, setType] = useState('')
    const [code, setCode] = useState(0)
    const [statement, setStatement] = useState('')
    const [isActive, setIsActive] = useState(false)
    const [codeExist, setCodeExist] = useState()

    //
    const accountsType = (val) =>{
        setType(val)
        let result  = accounts.filter((account,i) => {
           return account.type == val
        })
        setData(result)
    }

    //
    const generateCode = (arg) => {
      let newCode = parseInt(arg) +1
      console.log(newCode)
        //go through data
      let isCode = data.find((ele) => {
        return  parseInt(ele.code) == newCode
          })

          setCodeExist(isCode)
      //check if code exist
      if (isCode) {
        generateCode(newCode)
      }else{
        setCode(newCode)
      }
        getStatement()
    }

    //
    const getStatement = () =>{
       if (type == 'Asset' || type == 'Liability' || type == 'Equity') {
         setStatement('Balance Sheet')
       }else if(type == 'Revenue' | type == 'Expense'){
        setStatement('Income Statement')
       }
    }

  const clearFields = () =>{
   setName('')
   setCode('')
   setType([])
   setStatement('')
   setData(accounts)
  }

  //
  const validate = () => {
    if (name == "") {
        swal({
            text: "Add account name",
            icon: "warning",
          });
    }else if(statement ==""){
        swal({
            text: "Select which account it should follow ",
            icon: "warning",
          });
    }else if(codeExist){
      swal({
        text: "Account code already exist",
        icon: "warning",
      });
    }
  }

    //
    const submit = (e) => {
      validate()
      setIsActive(true)
        e.preventDefault()
        let data = {
        name,code,type,
        financial_statement:statement
        }

        axios.post('/company-accounts/account', data)
        .then((res) => {
            console.log(res.data);
            clearFields();
            swal({
                title: "Done",
                text: "New Account added",
                icon: "success",
              });
              setIsActive(false)
        })
        .catch((err) => {
          console.log("Something went wrong", err, "warning");
        })
    }

    useEffect(() => {
        axios
            .get("/company-accounts/accounts/all")
            .then((res) => {
                setAccounts(res.data);
                setData(res.data)
               // console.log(res.data)
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
    }, []);

  return (
    <div className="w-full">
              <h1 className="text-base text-left p-3 font-bold text-gray-800">
                  Add Account
              </h1>
              <div className="flex justify-center mx-auto px-4 py-9">
              <div className="w-9/12">
                <div className="flex flex-wrap -mx-2 mb-6">
                   {/* Name*/}
                    <div className="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label value="" className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Account Name
                        </label>
                      <input id="name" className="rounded border-gray-300 focus:border-indigo-300
                      focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" type="text" value={name}
                      onChange={e => setName(e.target.value)} required autoFocus />
                    </div>
                    <div className="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Type
                            </label>
                        <select className="form-select appearance-none block text-base font-normal text-gray-600
                        bg-white bg-no-repeat transition ease-in-out m-0
                        focus:text-gray-600 focus:bg-white focus:outline-none" value={type}
                        onChange={e => accountsType(e.target.value)} required>
                          <option>Select Type</option>
                          <option value="Asset">Asset</option>
                          <option value="Liability">Liability</option>
                          <option value="Equity">Equity</option>
                          <option value="Revenue">Revenue</option>
                          <option value="Expense">Expense</option>
                      </select>
                      </div>
                </div>

                <div className="flex flex-wrap -mx-2 mb-6">
                    <div className="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Add to group
                        </label>
                        <select className="form-select appearance-none block text-base font-normal text-gray-600
                        bg-white bg-no-repeat transition ease-in-out m-0
                        focus:text-gray-600 focus:bg-white focus:outline-none" name="type" id="type"
                        onChange={e => generateCode(e.target.value)} required>
                          <option>Which Should It Follow</option>
                          {data.map((account,i) => (
                              <option key={i} value={account.code}>{account.name} - {account.code}</option>
                          ))}
                      </select>
                      </div>
                {/*Financial Statement*/}
                    <div className="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Financial Statement
                        </label>
                        <input id="phone" className="rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                        focus:ring-opacity-50mt-1 w-full" type="text" value={statement} required autoFocus readOnly/>
                    </div>
                </div>
                <div className="flex flex-wrap -mx-2 mb-6">
                     {/*Code*/}
                    <div className="w-full md:w-1/2 px-3">
                       <label className="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        New Code
                        </label>
                       <input id="code" className="rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                       focus:ring-opacity-50 mt-1 w-full" type="text" value={code} required autoFocus/>
                   </div>
                </div>

                <div className="flex items-center justify-between mt-5 px-4">
                    <button className="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
                             focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out"
                             onClick={submit} disabled={isActive}>
                        Finish
                    </button>
                </div>

              </div>
            </div>
         </div>
  )
}

export default Account
if (document.getElementById("account-all")) {
    ReactDOM.render(<Account />, document.getElementById("account-all"));
}
