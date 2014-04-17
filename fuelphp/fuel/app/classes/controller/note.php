<?php
class Controller_Note extends Controller_Template{

	public function action_index()
	{
		$data['notes'] = Model_Note::find('all');
		$this->template->title = "Notes";
		$this->template->content = View::forge('note/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('note');

		if ( ! $data['note'] = Model_Note::find($id))
		{
			Session::set_flash('error', 'Could not find note #'.$id);
			Response::redirect('note');
		}

		$this->template->title = "Note";
		$this->template->content = View::forge('note/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Note::validate('create');
			
			if ($val->run())
			{
				$note = Model_Note::forge(array(
					'title' => Input::post('title'),
					'description' => Input::post('description'),
				));

				if ($note and $note->save())
				{
					Session::set_flash('success', 'Added note #'.$note->id.'.');

					Response::redirect('note');
				}

				else
				{
					Session::set_flash('error', 'Could not save note.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Notes";
		$this->template->content = View::forge('note/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('note');

		if ( ! $note = Model_Note::find($id))
		{
			Session::set_flash('error', 'Could not find note #'.$id);
			Response::redirect('note');
		}

		$val = Model_Note::validate('edit');

		if ($val->run())
		{
			$note->title = Input::post('title');
			$note->description = Input::post('description');

			if ($note->save())
			{
				Session::set_flash('success', 'Updated note #' . $id);

				Response::redirect('note');
			}

			else
			{
				Session::set_flash('error', 'Could not update note #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$note->title = $val->validated('title');
				$note->description = $val->validated('description');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('note', $note, false);
		}

		$this->template->title = "Notes";
		$this->template->content = View::forge('note/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('note');

		if ($note = Model_Note::find($id))
		{
			$note->delete();

			Session::set_flash('success', 'Deleted note #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete note #'.$id);
		}

		Response::redirect('note');

	}


}
