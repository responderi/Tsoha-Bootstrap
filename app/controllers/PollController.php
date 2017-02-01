<?php

	class PollController extends BaseController{
		$polls = Poll:all();
		View::make('polls/index.html', array('polls' => $polls));
	}