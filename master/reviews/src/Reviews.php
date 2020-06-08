<?php
namespace Master\Reviews;
use Master\Reviews\Interfaces\ReviewsRepositoryInterface;

class Reviews
{
	protected $review;
	public function __construct(ReviewsRepositoryInterface $review)
	{
		$this->review = $review;
	}
	
	public function setReview($book_id = '', $customer_id = '', $params = array())
	{
		// find sudah pernah di set apa belum
		$find = $this->review->findWhere(array('book_id' => $book_id, 'customer_id' => $customer_id))->first();
		if (!(bool)is_null($find)) {
			return false;
		}
		$query = $this->review->create($params);
		$this->review->resetModel();
		return $query;
	}
}