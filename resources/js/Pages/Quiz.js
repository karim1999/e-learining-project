import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import {Head} from '@inertiajs/inertia-react';
export default function({auth, errors, quiz, questions}) {
    return (
        <Authenticated
            auth={auth}
            errors={errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title={quiz.title} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">{quiz.description}</div>
                    </div>
                </div>
            </div>
            <div>
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white p-12 rounded-lg shadow-lg w-full mt-8">
                        {
                            questions.map((question) => (
                                <div key={question.id}>
                                    <p className="text-2xl font-bold">{question.title}</p>
                                    <p className="text-md">{question.description}</p>
                                    {
                                        question.options.map((option) => (
                                            <label key={option.id} htmlFor={`option_${option.id}`} className="block mt-4 border border-gray-300 rounded-lg py-2 px-6 text-lg">
                                                <input id={`option_${option.id}`} type="radio" className="hidden" value={option.id} disabled=""/>
                                                {option.title}
                                            </label>
                                        ))
                                    }
                                    <div className="mt-6 flow-root">
                                        <button className="float-right bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2"> Submit </button>
                                    </div>
                                </div>
                            ))
                        }
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
