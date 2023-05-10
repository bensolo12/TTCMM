<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\AuthorizedBuyersMarketplace\Resource;

use Google\Service\AuthorizedBuyersMarketplace\BatchUpdateDealsRequest;
use Google\Service\AuthorizedBuyersMarketplace\BatchUpdateDealsResponse;
use Google\Service\AuthorizedBuyersMarketplace\Deal;
use Google\Service\AuthorizedBuyersMarketplace\ListDealsResponse;

/**
 * The "deals" collection of methods.
 * Typical usage is:
 *  <code>
 *   $authorizedbuyersmarketplaceService = new Google\Service\AuthorizedBuyersMarketplace(...);
 *   $deals = $authorizedbuyersmarketplaceService->buyers_proposals_deals;
 *  </code>
 */
class BuyersProposalsDeals extends \Google\Service\Resource
{
  /**
   * Batch updates multiple deals in the same proposal. (deals.batchUpdate)
   *
   * @param string $parent Required. The name of the proposal containing the deals
   * to batch update. Format: buyers/{accountId}/proposals/{proposalId}
   * @param BatchUpdateDealsRequest $postBody
   * @param array $optParams Optional parameters.
   * @return BatchUpdateDealsResponse
   */
  public function batchUpdate($parent, BatchUpdateDealsRequest $postBody, $optParams = [])
  {
    $params = ['parent' => $parent, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('batchUpdate', [$params], BatchUpdateDealsResponse::class);
  }
  /**
   * Gets a deal given its name. The deal is returned at its head revision.
   * (deals.get)
   *
   * @param string $name Required. Format:
   * buyers/{accountId}/proposals/{proposalId}/deals/{dealId}
   * @param array $optParams Optional parameters.
   * @return Deal
   */
  public function get($name, $optParams = [])
  {
    $params = ['name' => $name];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], Deal::class);
  }
  /**
   * Lists all deals in a proposal. To retrieve only the finalized revision deals
   * regardless if a deal is being renegotiated, see the FinalizedDeals resource.
   * (deals.listBuyersProposalsDeals)
   *
   * @param string $parent Required. The name of the proposal containing the deals
   * to retrieve. Format: buyers/{accountId}/proposals/{proposalId}
   * @param array $optParams Optional parameters.
   *
   * @opt_param int pageSize Requested page size. The server may return fewer
   * results than requested. If requested more than 500, the server will return
   * 500 results per page. If unspecified, the server will pick a default page
   * size of 100.
   * @opt_param string pageToken The page token as returned from
   * ListDealsResponse.
   * @return ListDealsResponse
   */
  public function listBuyersProposalsDeals($parent, $optParams = [])
  {
    $params = ['parent' => $parent];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], ListDealsResponse::class);
  }
  /**
   * Updates the given deal at the buyer known revision number. If the server
   * revision has advanced since the passed-in proposal.proposal_revision an
   * ABORTED error message will be returned. The revision number is incremented by
   * the server whenever the proposal or its constituent deals are updated. Note:
   * The revision number is kept at a proposal level. The buyer of the API is
   * expected to keep track of the revision number after the last update operation
   * and send it in as part of the next update request. This way, if there are
   * further changes on the server (for example, seller making new updates), then
   * the server can detect conflicts and reject the proposed changes.
   * (deals.patch)
   *
   * @param string $name Immutable. The unique identifier of the deal. Auto-
   * generated by the server when a deal is created. Format:
   * buyers/{accountId}/proposals/{proposalId}/deals/{dealId}
   * @param Deal $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string updateMask List of fields to be updated. If empty or
   * unspecified, the service will update all fields populated in the update
   * request excluding the output only fields and primitive fields with default
   * value. Note that explicit field mask is required in order to reset a
   * primitive field back to its default value, for example, false for boolean
   * fields, 0 for integer fields. A special field mask consisting of a single
   * path "*" can be used to indicate full replacement(the equivalent of PUT
   * method), updatable fields unset or unspecified in the input will be cleared
   * or set to default value. Output only fields will be ignored regardless of the
   * value of updateMask.
   * @return Deal
   */
  public function patch($name, Deal $postBody, $optParams = [])
  {
    $params = ['name' => $name, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('patch', [$params], Deal::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(BuyersProposalsDeals::class, 'Google_Service_AuthorizedBuyersMarketplace_Resource_BuyersProposalsDeals');
