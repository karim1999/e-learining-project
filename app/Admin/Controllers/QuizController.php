<?php

namespace App\Admin\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QuizController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Quiz';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Quiz());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('duration', __('Duration'));
        $grid->column('start_date', __('Start date'))->diffForHumans();
        $grid->column('end_date', __('End date'))->diffForHumans();
        $grid->column('created_at', __('Created at'))->diffForHumans();
        $grid->column('updated_at', __('Updated at'))->diffForHumans();

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
        $show = new Show(Quiz::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('duration', __('Duration'));
        $show->field('start_date', __('Start date'))->diffForHumans();
        $show->field('end_date', __('End date'))->diffForHumans();
        $show->field('created_at', __('Created at'))->diffForHumans();
        $show->field('updated_at', __('Updated at'))->diffForHumans();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Quiz());

        $form->text('title', __('Title'))->required();
        $form->textarea('description', __('Description'));
        $form->number('duration', __('Duration in minutes'))->default(30)->required();
        $form->datetime('start_date', __('Start date'))->format('YYYY-MM-DD HH:mm')->default(date('Y-m-d H:i'))->required();
        $form->datetime('end_date', __('End date'))->format('YYYY-MM-DD HH:mm')->default(date('Y-m-d H:i'))->required();
        $form->multipleSelect('questions','Questions')->options(Question::all()->pluck('title','id'));

        return $form;
    }
}
