<?php

namespace App\Admin\Controllers;

use App\Models\Assessment;
use App\Models\Quiz;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AssessmentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Assessment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Assessment());

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User id'));
        $grid->column('quiz.title', __('Quiz id'));
        $grid->column('started_at', __('Started at'));
        $grid->column('score', __('Score'));
        $grid->column('finished_at', __('Finished at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Assessment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('User id'));
        $show->field('quiz.title', __('Quiz id'));
        $show->field('started_at', __('Started at'));
        $show->field('score', __('Score'));
        $show->field('finished_at', __('Finished at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Assessment());

        $form->select('user_id', __('User'))->options(User::all()->pluck('name', 'id'));
        $form->number('quiz_id', __('Quiz'))->options(Quiz::all()->pluck('title', 'id'));
        $form->datetime('started_at', __('Started at'))->default(date('Y-m-d H:i:s'));
        $form->number('score', __('Score'))->default(0);
        $form->datetime('finished_at', __('Finished at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
