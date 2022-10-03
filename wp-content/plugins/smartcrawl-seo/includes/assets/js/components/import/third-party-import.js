import React from "react";
import {__} from "@wordpress/i18n";
import Button from "../button";
import ImportModal from "./import-modal";

export default class ThirdPartyImport extends React.Component {
	static defaultProps = {
		indexSettingsUrl: "",
		nonce: "",
		isMultisite: false,
		hasAioSeoData: false,
	};

	constructor(props) {
		super(props);

		this.state = {
			source: "",
			sourceName: "",
			openDialog: false,
		};
	}

	render() {
		const {indexSettingsUrl, hasAioSeoData, nonce, isMultisite} = this.props;
		const {source, sourceName, openDialog} = this.state;

		return (
			<React.Fragment>
				<div className="sui-box-settings-row">
					<div className="sui-box-settings-col-1">
						<label className="sui-settings-label">{__("Import", "wds")}</label>
						<p className="sui-description">
							{__("Use this tool to import your SmartCrawl settings from another site.", "wds")}
						</p>
					</div>
					<div className="sui-box-settings-col-2 wds-io wds-import">
						<label className="sui-settings-label">{__("Third Party", "wds")}</label>
						<p className="sui-description">
							{__("Automatically import your SEO configuration from other SEO plugins.", "wds")}
						</p>

						<table className="sui-table">
							<tbody>
							<tr className="wds-yoast">
								<td>
									<strong>{__("Yoast SEO", "wds")}</strong>
								</td>
								<td>
									<Button
										icon="sui-icon-download-cloud"
										onClick={() => this.openDialog("yoast")}
										text={__("Import", "wds")}
									/>
								</td>
							</tr>
							{!!hasAioSeoData && (
								<tr className="wds-aioseop">
									<td>
										<strong>{__("All In One SEO", "wds")}</strong>
									</td>
									<td>
										<Button
											icon="sui-icon-download-cloud"
											onClick={() => this.openDialog("aioseop")}
											text={__("Import", "wds")}
										/>
									</td>
								</tr>
							)}
							</tbody>
						</table>
						<p className="sui-description">
							{__(
								"Automatically import your SEO configuration from other SEO plugins. Note: This will override all of your current settings. We recommend exporting your current settings first, just in case.",
								"wds",
							)}
						</p>
					</div>
				</div>
				{openDialog && (
					<ImportModal
						onClose={() => this.closeDialog()}
						source={source}
						sourceName={sourceName}
						nonce={nonce}
						indexSettingsUrl={indexSettingsUrl}
						isMultisite={isMultisite}
					/>
				)}
			</React.Fragment>
		);
	}

	openDialog(source) {
		const sourceName = source === "yoast" ?
			__("Yoast", "wds") :
			source === "aioseop" ? __("All In One SEO", "wds") : false;

		this.setState({
			source,
			sourceName,
			openDialog: true,
		});
	}

	closeDialog() {
		this.setState({openDialog: false});
	}
}
