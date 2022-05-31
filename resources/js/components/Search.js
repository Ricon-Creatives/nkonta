import React ,{useState} from 'react'
import ReactDOM from 'react-dom';


const Search = () => {
const [search, setSearch] = useState('')

  return (

        <div className="flex flex-row items-center justify-center">
            <div className='mx-1'>
            <input id="type" type="text" value={search} className="block w-full rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 py-1" placeholder="Search..." autofocus />
            </div>
        <button type="button" className="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
            focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
            Search
            </button>
        </div>
  )
}

export default Search

if (document.getElementById('search-area')) {
    ReactDOM.render(<Search />, document.getElementById('search-area'));
}
