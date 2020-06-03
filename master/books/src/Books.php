<?php
namespace Master\Books;

use Master\Books\Interfaces\BooksRepositoryInterface;
use Master\Books\Interfaces\HistoryRepositoryInterface;

class Books
{
	protected $book;
	protected $history;

	public function __construct(
		BooksRepositoryInterface $book,
		HistoryRepositoryInterface $history
	)
	{
		$this->book = $book;
		$this->history = $history;
	}

	public function updateOrCreateHistory($attribute, $params)
	{
		$query = $this->history->updateOrCreate($attribute, $params);
		$this->history->resetModel();
		return $query;
	}

	public function findHistory($uuid = '')
	{
		$query = $this->history->findByField('uuid', $uuid)->first();
		$this->history->resetModel();
		return $query;
	}

	public function createBookPending($params)
	{
		$query = $this->book->create($params);
		$this->book->resetModel();
		return $query;
	}

	public function findBook($uuid='')
	{
		$query = $this->book->findByField('uuid', $uuid)->first();
		$this->book->resetModel();
		return $query;
	}

	public function updateBook($id='', $params)
	{
		$query = $this->book->update($params, $id);
		$this->book->resetModel();
		return $query;
	}

}