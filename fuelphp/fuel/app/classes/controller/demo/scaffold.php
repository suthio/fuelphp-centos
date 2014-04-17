<?php
class Controller_Demo_Scaffold extends Controller_Template{

	public function action_index()
	{
		$data['demo_scaffolds'] = Model_Demo_Scaffold::find('all');
		$this->template->title = "Demo_scaffolds";
		$this->template->content = View::forge('demo/scaffold/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('demo/scaffold');

		if ( ! $data['demo_scaffold'] = Model_Demo_Scaffold::find($id))
		{
			Session::set_flash('error', 'Could not find demo_scaffold #'.$id);
			Response::redirect('demo/scaffold');
		}

		$this->template->title = "Demo_scaffold";
		$this->template->content = View::forge('demo/scaffold/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Demo_Scaffold::validate('create');
			
			if ($val->run())
			{
				$demo_scaffold = Model_Demo_Scaffold::forge(array(
					'title' => Input::post('title'),
					'content' => Input::post('content'),
					'id' => Input::post('id'),
				));

				if ($demo_scaffold and $demo_scaffold->save())
				{
					Session::set_flash('success', 'Added demo_scaffold #'.$demo_scaffold->id.'.');

					Response::redirect('demo/scaffold');
				}

				else
				{
					Session::set_flash('error', 'Could not save demo_scaffold.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Demo_Scaffolds";
		$this->template->content = View::forge('demo/scaffold/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('demo/scaffold');

		if ( ! $demo_scaffold = Model_Demo_Scaffold::find($id))
		{
			Session::set_flash('error', 'Could not find demo_scaffold #'.$id);
			Response::redirect('demo/scaffold');
		}

		$val = Model_Demo_Scaffold::validate('edit');

		if ($val->run())
		{
			$demo_scaffold->title = Input::post('title');
			$demo_scaffold->content = Input::post('content');
			$demo_scaffold->id = Input::post('id');

			if ($demo_scaffold->save())
			{
				Session::set_flash('success', 'Updated demo_scaffold #' . $id);

				Response::redirect('demo/scaffold');
			}

			else
			{
				Session::set_flash('error', 'Could not update demo_scaffold #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$demo_scaffold->title = $val->validated('title');
				$demo_scaffold->content = $val->validated('content');
				$demo_scaffold->id = $val->validated('id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('demo_scaffold', $demo_scaffold, false);
		}

		$this->template->title = "Demo_scaffolds";
		$this->template->content = View::forge('demo/scaffold/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('demo/scaffold');

		if ($demo_scaffold = Model_Demo_Scaffold::find($id))
		{
			$demo_scaffold->delete();

			Session::set_flash('success', 'Deleted demo_scaffold #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete demo_scaffold #'.$id);
		}

		Response::redirect('demo/scaffold');

	}


}
