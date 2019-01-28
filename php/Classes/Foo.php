<?php
namespace rdominguez\ObjectOriented;

/**
 * Trying to make a class for object-oriented
 *
 * This is the author
 * Currently has all the information necessary
 *
 * @author Robert Dominguez <rdominguez45@cnm.edu>
 **/
class Author {
	use Uuid;
	/**
	 * id for this Author; this is the primary key
	 **/
	private $authorId;
	private $authorAvatarUrl;
	private $authorActivationToken;
	private $authorEmail;
	private $authorHash;
	private $authorUsername;

	/**
	 * accessor method for author Id
	 *
	 * @return int value of author Id
	 **/
	public function getAuthorId() {
		return $this->authorId;
	}
	/**
	 * mutator method for profile id
	 *
	 * @param int $newAuthorId new value of profile id
	 * @throws \UnexpectedValueException if $newAuthorId is not an integer
	 **/
	/**
	 * @param mixed $authorId
	 */
	public function setAuthorId($newAuthorId) {
		$newAuthorId = filter_var($newAuthorId, FILTER_VALIDATE_INT);
		if($newAuthorId === false) {
			throw (new UnexpectedValueException("author id is not a valid integer"))
		}

		//convert and store the author id
		$this->authorId = intval($newAuthorId);
	}
}
?>