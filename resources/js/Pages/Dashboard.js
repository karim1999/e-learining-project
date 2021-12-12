import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import {Head, Link, usePage} from '@inertiajs/inertia-react';
import TableTh from "@/Components/Table/TableTh";
import TableTd from "@/Components/Table/TableTd";
import moment from "moment";
import Button from "@/Components/Button";
import Alert from "@/Components/Alert";

export default function Dashboard({auth, errors, quizzes}) {
    const { flash } = usePage().props
    return (
        <Authenticated
            auth={auth}
            errors={errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            {flash.message && (
                <Alert>
                    {flash.message}
                </Alert>
            )}
            {
                quizzes.length > 0 ?
                    <div className="py-3">
                        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <table className="min-w-full divide-y divide-gray-200">
                                <thead className="bg-gray-50">
                                <tr>
                                    <TableTh>
                                        Title
                                    </TableTh>
                                    <TableTh>
                                        Duration
                                    </TableTh>
                                    <TableTh>
                                        Start/End Dates
                                    </TableTh>
                                    <TableTh>
                                        Score
                                    </TableTh>
                                    <TableTh>
                                        Actions
                                    </TableTh>
                                </tr>
                                </thead>
                                <tbody className="bg-white divide-y divide-gray-200">
                                {
                                    quizzes.map((quiz) => (
                                        <tr key={quiz.id}>
                                            <TableTd>
                                                {quiz.title}
                                            </TableTd>
                                            <TableTd>
                                                {quiz.duration} minutes
                                            </TableTd>
                                            <TableTd>
                                                {moment(quiz.start_date).fromNow()} : {moment(quiz.end_date).fromNow()}
                                            </TableTd>
                                            <TableTd>
                                                {quiz.assessments?.[0]?.finished_at ? `${quiz.assessments?.[0]?.score}/${quiz.questions_count}` : "-"}
                                            </TableTd>
                                            <TableTd>
                                                {(quiz.assessments?.[0]?.finished_at || moment(quiz.end_date).isBefore()) ? "-" : (
                                                    <Link href={route('quizzes.take', {quiz: quiz.id})}>
                                                        <Button>
                                                            Start
                                                        </Button>
                                                    </Link>
                                                )}
                                            </TableTd>
                                        </tr>
                                    ))
                                }

                                </tbody>
                            </table>
                        </div>
                    </div>
                    :
                    <div className="py-12">
                        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div className="p-6 bg-white border-b border-gray-200">You don't have any quizzes to complete.</div>
                            </div>
                        </div>
                    </div>
            }
        </Authenticated>
    );
}
