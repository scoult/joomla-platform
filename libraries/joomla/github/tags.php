<?php

defined('JPATH_PLATFORM') or die();

/**
 * GitHub API Issues class for the Joomla Platform.
 *
 * @package     Joomla.Platform
 * @subpackage  GitHub
 * @since       11.3
 */
class JGithubTags extends JGithubObject
{


        /**
	 * Method to get a single issue.
	 *
	 * @param   string   $user     The name of the owner of the GitHub repository.
	 * @param   string   $repo     The name of the GitHub repository.
	 * @param   integer  $tagId    The tag number.
	 *
	 * @return  object
	 *
	 * @since   12.2
	 */

	public function get($user, $repo, $tagId)
	{
		// Build the request path.
		$path = '/repos/' . $user . '/' . $repo . '/tags/' . (int) $tagId;

		// Send the request.
		$response = $this->client->get($this->fetchUrl($path));

		// Validate the response code.
		if ($response->code != 200)
		{
			// Decode the error response and throw an exception.
			$error = json_decode($response->body);
			throw new DomainException($error->message, $response->code);
		}

		return json_decode($response->body);
	}
        
        
        /**
	 * Method to list tags.
	 *
	 * @param   string   $user       The name of the owner of the GitHub repository.
	 * @param   string   $repo       The name of the GitHub repository.
	 *
	 * @return  array
	 *
	 * @since   12.2
	 */
	public function getListByRepository($user, $repo)	{
		// Build the request path.
		$path = '/repos/' . $user . '/' . $repo . '/tags';
                
		// Send the request.
		$response = $this->client->get($this->fetchUrl($path, $page, $limit));

		// Validate the response code.
		if ($response->code != 200)
		{
			// Decode the error response and throw an exception.
			$error = json_decode($response->body);
			throw new DomainException($error->message, $response->code);
		}
                
		return json_decode($response->body);
	}
        
        
}