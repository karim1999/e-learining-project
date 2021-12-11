import React, {useState} from 'react';
import Authenticated from '@/Layouts/Authenticated';
import {Head} from '@inertiajs/inertia-react';
import Button from "@/Components/Button";
import {Inertia} from "@inertiajs/inertia";
export default function({auth, errors, quiz, questions}) {
    const [answers, setAnswers]= useState(questions.map(question => ({
        question_id: question.id,
        option_id: null
    })));
    const [isLoading, setIsLoading]= useState(false);
    const onSelectOption= (question_id, option_id) => {
        let tempAnswers= [...answers];
        tempAnswers.find(answer => answer.question_id === question_id).option_id= option_id;
        setAnswers(tempAnswers);
    }
    const onSubmit= async (e) => {
        setIsLoading(true);
        e.preventDefault()
        await Inertia.post(route('quizzes.submit', {quiz: quiz.id}), {answers})
        setIsLoading(false);
    }
    return (
        <Authenticated
            auth={auth}
            errors={errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title={quiz.title} />

            <div className="py-5">
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
                                <div className="mb-3" key={question.id}>
                                    <p className="text-2xl font-bold">{question.title}</p>
                                    <p className="text-md">{question.description}</p>
                                    {
                                        question.options.map((option) => (
                                            <label key={option.id} htmlFor={`option_${option.id}`} className={`block mt-4 border border-gray-300 rounded-lg py-2 px-6 text-lg
                                            ${answers.find(answer => answer.question_id === question.id).option_id === option.id && "bg-green-200"}`}>
                                                <input onChange={() => onSelectOption(question.id, option.id)} id={`option_${option.id}`} type="radio" className="hidden" value={option.id}/>
                                                {option.title}
                                            </label>
                                        ))
                                    }
                                </div>
                            ))
                        }
                        <div className="mt-6 flow-root">
                            <Button onClick={onSubmit} processing={isLoading}> Submit </Button>
                        </div>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
