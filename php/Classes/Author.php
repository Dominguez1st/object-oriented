<?php
namespace rdominguez\ObjectOriented;

require_once ("autoload.php");
require_once ("ValidateDate.php");
require_once ("ValidateUuid.php");
require_once (dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * Trying to make a class for object-oriented
 *
 * This is the author
 * Currently has all the information necessary
 *
 * @author Robert Dominguez <rdominguez45@cnm.edu>
 * @version 1.0.0
 **/
class Author implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this Author; this is the primary key
	 * @var Uuid $authorId
	 **/
	private $authorId;
	/**
	 * @var string $authorAvatarUrl
	 **/
	private $authorAvatarUrl;
	/**
	 * @var string $authorActivationToken
	 **/
	private $authorActivationToken;
	/**
	 * @var string $authorEmail
	 **/
	private $authorEmail;
	/**
	 * @var string $authorHash
	 **/
	private $authorHash;
	/**
	 * @var string $authorUsername
	 **/
	private $authorUsername;

	/**
	 * constructor for this Author
	 *
	 * @param string|Uuid $newAuthorId
	 * @param string $newAuthorAvatarUrl
	 * @param string $newAuthorActivationToken
	 * @param string $newAuthorEmail
	 * @param string $newAuthorHash
	 * @param string $newAuthorUsername
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newAuthorId, $newAuthorAvatarUrl,$newAuthorActivationToken, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		}

		// determines what exception was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception){
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * accessor method for author id
	 *
	 * @return Uuid value of author id
	 **/
	public function getAuthorId() : Uuid {
		return($this->authorId);
	}
	/**
	 * mutator method for author id
	 *
	 * @param Uuid|string $newAuthorId
	 * @throws \RangeException if $newAuthorId is not possible
	 * @throws \TypeError if $newAuthorId is not a uuid or sting
	 **/
	public function setAuthorId( $newAuthorId) : void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception){
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the author id
		$this->authorId = $uuid;
	}


	/**
	 * accessor method for author avatar url
	 *
	 * @return string value of author avatar url
	 **/
	public function getAuthorAvatarUrl() : string {
		return($this->authorAvatarUrl);
	}
	/**
	 * mutator method for author avatar url
	 *
	 * @param string $newAuthorAvatarUrl
	 * @throws \InvalidArgumentException if $newAuthorActivationToken is not a string or secure
	 * @throws \RangeException if $newAuthorActivationToken is > 255 characters
	 * @throws \TypeError if $newAuthorActivationToken
	 **/
	public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) : void {
		// verify the Author Avatar Url secure
		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorAvatarUrl) === true) {
			throw(new \InvalidArgumentException("author avatar url is empty or insecure"));
		}
		// verify the author avatar url will fit in the database
		if(strlen($newAuthorAvatarUrl) > 140) {
			throw(new \RangeException("author avatar url is too large"));
		}
		// store the author avatar url
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}


	/**
	 * accessor method for author Activation Token
	 *
	 * @return string value of $author Activation Token
	 **/
	public function getAuthorActivationToken() : string {
		return($this->authorActivationToken);
	}
	/**
	 * mutator method for author Activation Token
	 *
	 * @param string $newAuthorActivationToken
	 * @throws \InvalidArgumentException if $newAuthorActivationToken is not a string or secure
	 * @throws \RangeException if $newAuthorActivationToken is > 32 characters
	 * @throws \TypeError if $newAuthorActivationToken
	 **/
	public function setAuthorActivationToken(string $newAuthorActivationToken) : void {
		// verify the Author Activation Token secure
		$newAuthorActivationToken = trim($newAuthorActivationToken);
		$newAuthorActivationToken = filter_var($newAuthorActivationToken, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorActivationToken) === true) {
			throw(new \InvalidArgumentException("Author Activation Token is empty or insecure"));
		}
		// verify the Author Activation Token url will fit in the database
		if(strlen($newAuthorActivationToken) > 32) {
			throw(new \RangeException("Author Activation Token is too large"));
		}
		// store the author avatar url
		$this->authorActivationToken = $newAuthorActivationToken;
	}


	/**
	 * accessor method for author Email
	 *
	 * @return string value of author Email
	 **/
	public function getAuthorEmail() : string {
		return($this->authorEmail);
	}
	/**
	 * mutator method for author Email
	 *
	 * @param string $newAuthorEmail
	 * @throws \InvalidArgumentException if $newAuthorEmail is not a string or secure
	 * @throws \RangeException if $newAuthorEmail is > 128 characters
	 * @throws \TypeError if $newAuthorEmail
	 **/
	public function setAuthorEmail(string $newAuthorEmail) : void {
		// verify the author Email is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("author Email is empty or insecure"));
		}
		// verify the Author email will fit in the database
		if(strlen($newAuthorEmail) > 140) {
			throw(new \RangeException("author Email is too large"));
		}
		// store the author avatar url
		$this->authorEmail = $newAuthorEmail;
	}


	/**
	 * accessor method for author hash
	 *
	 * @return string value of author hash
	 **/
	public function getAuthorHash() : string {
		return($this->authorHash);
	}
	/**
	 * mutator method for author Hash
	 *
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if $newAuthorHash is not a string or secure
	 * @throws \RangeException if $newAuthorHash is > 97 characters
	 * @throws \TypeError if $newAuthorHash
	 **/
	public function setAuthorHash(string $newAuthorHash) : void {
		// verify the author hash is secure
		$newAuthorHash = trim($newAuthorHash);
		$newAuthorHash = filter_var($newAuthorHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("author hash is empty or insecure"));
		}

		// verify the Author hash will fit in the database
		if(strlen($newAuthorHash) > 97) {
			throw(new \RangeException("author hash is too large"));
		}
		// store the author hash
		$this->authorHash = $newAuthorHash;
	}


	/**
	 * accessor method for author username
	 *
	 * @return string value of author username
	 **/
	public function getAuthorUsername() : string {
		return($this->authorUsername);
	}
	/**
	 * mutator method for author username
	 *
	 * @param string $newAuthorUsername
	 * @throws \InvalidArgumentException if $newAuthorUsername is not a string or secure
	 * @throws \RangeException if $newAuthorUsername is > 32 characters
	 * @throws \TypeError if $newAuthorUsername
	 **/
	public function setAuthorUsername(string $newAuthorUsername) : void {
		// verify the author hash is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("author username is empty or insecure"));
		}
		// verify the Author username will fit in the database
		if(strlen($newAuthorUsername) > 32) {
			throw(new \RangeException("author username is too large"));
		}
		// store the author username
		$this->authorUsername = $newAuthorUsername;
	}


	/**
	 * inserts this Author into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occurs
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert (\PDO $pdo) : void {

		//create query template
		$query = "INSERT INTO author(authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername)
		VALUES (:authorId, :authorAvatarUrl, :authorActivationToken, :authorEmail, :authorHash, :authorUsername)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["authorId" => $this->authorId->getBytes(), "authorAvatarUrl"=> $this->authorAvatarUrl->getBytes(),
			"authorActivationToken" => $this->authorActivationToken->getBytes(), "authorEmail" => $this->authorEmail->getBytes(),
			"authorHash" => $this->authorHash->getBytes(), "authorUsername" => $this->authorUsername->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * deletes this from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throw \PDOException when mySQL related errors occur
	 * @throw \TypeError if $pdo is not a PDO connection object
	 */
	public function delete (\PDO $pdo) : void {

		//create query template
		$query = "DELETE FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["authorId" => $this->authorId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Author in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occurs
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE author SET authorAvatarUrl = :authorAvatarUrl, authorActivationToken = :authorActivationToken,
			authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getBytes(), "authorAvatarUrl"=> $this->authorAvatarUrl->getBytes(),
			"authorActivationToken" => $this->authorActivationToken->getBytes(), "authorEmail" => $this->authorEmail->getBytes(),
			"authorHash" => $this->authorHash->getBytes(), "authorUsername" => $this->authorUsername->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * gets the Author by authorId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $authorId author id to search for
	 * @return Author|null Author found or null if not found
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \ThrowErrors when a variable are not the correct data type
	 **/
	public function getAuthorByAuthorId(\PDO $pdo, $authorId) : ?Author {
		// sanitize the authorId before searching
		try {
			$authorId = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception){
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the author id to the place holder in the template
		$parameters = ["authorId" => $authorId->getBytes()];
		$statement->execute($parameters);

		// grab the author from mySQL
		try {
			$author = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"],
					$row["authorHash"], $row["authorUsername"]);
			}
		} catch(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(),0, $exception));
		}
		return ($author);
	}

	/**
	 * gets all Authors
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Authors found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllAuthors(\PDO $pdo) : \SPLFixedArray {
		//creates query template
		$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of authors
		$authors = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try {
				$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"],$row["authorEmail"],
					$row["authorHash"], $row["authorUsername"]);
				$authors[$authors->key()] = $author;
				$authors->next();
			} catch(\Exception $exception){
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($authors);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);
		$fields["authorId"] = $this->authorId->toString();
		return ($fields);
	}
}
?>