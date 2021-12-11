<?php

namespace App\Admin\Controllers;

use App\Models\Answer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AnswerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Answer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Answer());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('quiz_id', __('Quiz id'));
        $grid->column('option_id', __('Option id'));
        $grid->column('correct', __('Correct'));
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
        $show = new Show(Answer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('quiz_id', __('Quiz id'));
        $show->field('option_id', __('Option id'));
        $show->field('correct', __('Correct'));
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
        $form = new Form(new Answer());

        $form->number('user_id', __('User id'));
        $form->number('quiz_id', __('Quiz id'));
        $form->number('option_id', __('Option id'));
        $form->switch('correct', __('Correct'));

        return $form;
    }
}
